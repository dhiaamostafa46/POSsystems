<?php

namespace App\Http\Controllers;

use App\Models\Accounting_guide;
use App\Models\Arrangement;
use App\Models\Bank;
use App\Models\Credorder;
use App\Models\Customer;
use App\Models\Debitorder;
use App\Models\DepotStore;
use App\Models\Duration;
use App\Models\IncomTransfers;
use App\Models\Invoice;
use App\Models\Journal;
use App\Models\JournalSub;
use App\Models\Manufactur;
use App\Models\OpeningBalances;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\OrderInv;
use App\Models\OrderinvDetails;
use App\Models\Outcome;
use App\Models\Outcomecategory;
use App\Models\Prodcategory;
use App\Models\Product;
use App\Models\ProdUnit;
use App\Models\Purchase;
use App\Models\Purchasedetails;
use App\Models\ReportData;
use App\Models\Role;
use App\Models\ExpensDetails;
use App\Models\Stock;
use App\Models\Stockinout;
use App\Models\Stockinoutdetails;
use App\Models\StoreConversion;
use App\Models\Supplier;
use App\Models\Tainted;
use App\Models\TaintedDetail;
use App\Models\Tbl;
use App\Models\Treasury;
use App\Models\User;
use App\Models\Expenses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportAllController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        session()->put('page', 'Report');

        $account = Accounting_guide::where('orgID', auth()->user()->orgID)
            ->orderBy('AccountID')
            ->get();
        $users = User::where('status', 1)
            ->where('orgID', auth()->user()->orgID)
            ->get();

        return view('admin.report.index')->with('account', $account)->with('User', $users);
    }

    public function Accountsummary(Request $request)
    {
        $this->validate($request, [
            'AccountSelect' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        session()->put('page', 'Report');
        $data = explode('::', $request->AccountSelect);

        $falagesale = 0;
        $falagpurches = 0;
        $falagsandat = 0;
        $falagpayment = 0;
        //   dd(  $data[1][0]);
        if (substr($data[1], 0, 2) === '41') {
            $falagesale = 1;

            // whereDate('dateCon','<=',$request->datato)->whereDate('dateCon','>',$request->datafrom)
            $Order1 = Order::where('orgID', auth()->user()->orgID)
                ->where('salaseAccount', $data[1])
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
            $Order2 = OrderInv::where('orgID', auth()->user()->orgID)
                ->where('TypeInv', 2)
                ->where('salaseAccount', $data[1])
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
            $Order = $Order1->merge($Order2);
        } else {
            $falagesale = 0;
            $Order1 = Order::where('orgID', auth()->user()->orgID)
                ->where('AccountID', 'like', '%' . $data[1] . '%')
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
            $Order2 = OrderInv::where('orgID', auth()->user()->orgID)
                ->where('TypeInv', 2)
                ->where('AccountID', $data[1])
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
            $Order = $Order1->merge($Order2);
        }

        if (substr($data[1], 0, 2) == '41') {
            $falagpayment = 41;
        } elseif (substr($data[1], 0, 3) == '122') {
            $falagpayment = 122;
        } else {
            $falagpayment = 121;
        }

        if (substr($data[1], 0, 2) === '51') {
            $falagpurches = 1;
            $Purchase = Purchase::where('orgID', auth()->user()->orgID)
                ->where('kind', '2')
                ->where('AccountPurch', $data[1])
                ->whereDate('invoiceDate', '>', $request->from)
                ->whereDate('invoiceDate', '<=', $request->to)
                ->get();
        } else {
            $falagpurches = 0;
            $Purchase = Purchase::where('orgID', auth()->user()->orgID)
                ->where('kind', '2')
                ->where('AccountID', $data[1])
                ->whereDate('invoiceDate', '>', $request->from)
                ->whereDate('invoiceDate', '<=', $request->to)
                ->get();
        }

        if (substr($data[1], 0, 3) === '124') {
            $falagsandat = 1;
            $Invoice = Invoice::where('orgID', auth()->user()->orgID)
                ->where('Accountinv', $data[1])
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
        } elseif (substr($data[1], 0, 3) === '221') {
            $falagsandat = 2;
            $Invoice = Invoice::where('orgID', auth()->user()->orgID)
                ->where('Accountinv', $data[1])
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
        } else {
            $Invoice = Invoice::where('orgID', auth()->user()->orgID)
                ->where('AccountID', $data[1])
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
        }

         if (substr($data[1], 0, 1) === '5') {

            $OutCome = ExpensDetails::where('orgID', auth()->user()->orgID)
            ->where('outAccount', $data[1])->where('kind',2)
            ->whereDate('created_at', '>', $request->from)
            ->whereDate('created_at', '<=', $request->to)
            ->get();

        }else{

            $OutCome = ExpensDetails::where('orgID', auth()->user()->orgID)
            ->where('nameAccount', $data[1])->where('kind',2)
            ->whereDate('created_at', '>', $request->from)
            ->whereDate('created_at', '<=', $request->to)
            ->get();

        }

        $OpeningBalances = OpeningBalances::where('orgID', auth()->user()->orgID)
            ->where('CodeAccount', $data[1])
            ->whereDate('date', '>', $request->from)
            ->whereDate('date', '<=', $request->to)
            ->get();
        $JournalSub = JournalSub::where('orgID', auth()->user()->orgID)
            ->where('CodeAccount', $data[1])
            ->whereDate('date', '>', $request->from)
            ->whereDate('date', '<=', $request->to)
            ->get();
        $DepotStore = DepotStore::where('orgID', auth()->user()->orgID)
            ->where('AccountID', $data[1])
            ->whereDate('date', '>', $request->from)
            ->whereDate('date', '<=', $request->to)
            ->get();
        $credorders = Credorder::where('orgID', auth()->user()->orgID)
            ->where('AccountID', $data[1])
            ->whereDate('created_at', '>', $request->from)
            ->whereDate('created_at', '<=', $request->to)
            ->get();
        $depiteOrder = Debitorder::where('orgID', auth()->user()->orgID)
            ->where('AccountID', $data[1])
            ->whereDate('created_at', '>', $request->from)
            ->whereDate('created_at', '<=', $request->to)
            ->get();

        return view('admin.report.Allreport.Accountsummary', ['falagpayment' => $falagpayment, 'Order' => $Order, 'Purchase' => $Purchase, 'Invoice' => $Invoice, 'OutCome' => $OutCome, 'OpeningBalances' => $OpeningBalances, 'JournalSub' => $JournalSub, 'DepotStore' => $DepotStore, 'credorders' => $credorders, 'depiteOrder' => $depiteOrder, 'falagesale' => $falagesale, 'falagpurches' => $falagpurches, 'falagsandat' => $falagsandat, 'code' => $data[1], 'name' => $data[2]]);
    }

    public function LedgerAccount(Request $request)
    {
        $this->validate($request, [
            'AccountSelect' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);
        session()->put('page', 'Report');
        $data = explode('::', $request->AccountSelect);

        $falagesale = 0;
        $falagpurches = 0;
        $falagsandat = 0;
        $falagpayment = 0;
        if (substr($data[1], 0, 2) == '41') {
            $falagpayment = 41;
        } elseif (substr($data[1], 0, 3) == '122') {
            $falagpayment = 122;
        } else {
            $falagpayment = 121;
        }

        //   dd(  $data[1][0]);
        if (substr($data[1], 0, 2) === '41') {
            $falagesale = 1;
            $Order1 = Order::where('orgID', auth()->user()->orgID)
                ->where('salaseAccount', $data[1])
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
            $Order2 = OrderInv::where('orgID', auth()->user()->orgID)
                ->where('TypeInv', 2)
                ->where('salaseAccount', $data[1])
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
            $Order = $Order1->merge($Order2);
            //    dd( $Order);
        } else {
            $falagesale = 0;
            $Order1 = Order::where('orgID', auth()->user()->orgID)
                ->where('AccountID', 'like', '%' . $data[1] . '%')

                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
            $Order2 = OrderInv::where('orgID', auth()->user()->orgID)
                ->where('TypeInv', 2)
                ->where('AccountID', $data[1])
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
            $Order = $Order1->merge($Order2);
        }

        if (substr($data[1], 0, 2) === '51') {
            $falagpurches = 1;
            $Purchase = Purchase::where('orgID', auth()->user()->orgID)
                ->where('kind', '2')
                ->where('AccountPurch', $data[1])
                ->whereDate('invoiceDate', '>', $request->from)
                ->whereDate('invoiceDate', '<=', $request->to)
                ->get();
        } else {
            $falagpurches = 0;
            $Purchase = Purchase::where('orgID', auth()->user()->orgID)
                ->where('kind', '2')
                ->where('AccountID', $data[1])
                ->whereDate('invoiceDate', '>', $request->from)
                ->whereDate('invoiceDate', '<=', $request->to)
                ->get();
        }

        if (substr($data[1], 0, 3) === '124') {
            $falagsandat = 1;
            $Invoice = Invoice::where('orgID', auth()->user()->orgID)
                ->where('Accountinv', $data[1])
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
        } elseif (substr($data[1], 0, 3) === '221') {
            $falagsandat = 2;
            $Invoice = Invoice::where('orgID', auth()->user()->orgID)
                ->where('Accountinv', $data[1])
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
        } else {
            $Invoice = Invoice::where('orgID', auth()->user()->orgID)
                ->where('AccountID', $data[1])
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
        }

        //  $Invoice =Invoice::where('orgID',auth()->user()->orgID)->where('AccountID',$data[1])->whereDate('created_at','>',$request->from)->whereDate('created_at','<=',$request->to)->get();
        // $OutCome =Outcomecategory::where('orgID',auth()->user()->orgID)->where('AccountID',$data[1])->whereDate('created_at','>',$request->from)->whereDate('created_at','<=',$request->to)->get();
       if (substr($data[1], 0, 1) === '5') {
            $OutCome = ExpensDetails::where('orgID', auth()->user()->orgID)
                ->where('outAccount', $data[1])
                ->where('kind', 2)
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
        } else {
            $OutCome = ExpensDetails::where('orgID', auth()->user()->orgID)
                ->where('nameAccount', $data[1])
                ->where('kind', 2)
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->get();
        }
        
        
        $OpeningBalances = OpeningBalances::where('orgID', auth()->user()->orgID)
            ->where('CodeAccount', $data[1])
            ->whereDate('date', '>', $request->from)
            ->whereDate('date', '<=', $request->to)
            ->get();
        $JournalSub = JournalSub::where('orgID', auth()->user()->orgID)
            ->where('CodeAccount', $data[1])
            ->whereDate('date', '>', $request->from)
            ->whereDate('date', '<=', $request->to)
            ->get();
        $DepotStore = DepotStore::where('orgID', auth()->user()->orgID)
            ->where('AccountID', $data[1])
            ->whereDate('date', '>', $request->from)
            ->whereDate('date', '<=', $request->to)
            ->get();
        $credorders = Credorder::where('orgID', auth()->user()->orgID)
            ->where('AccountID', $data[1])
            ->whereDate('created_at', '>', $request->from)
            ->whereDate('created_at', '<=', $request->to)
            ->get();
        $depiteOrder = Debitorder::where('orgID', auth()->user()->orgID)
            ->where('AccountID', $data[1])
            ->whereDate('created_at', '>', $request->from)
            ->whereDate('created_at', '<=', $request->to)
            ->get();

        return view('admin.report.Allreport.ReportLedger', ['falagpayment' => $falagpayment, 'Order' => $Order, 'Purchase' => $Purchase, 'Invoice' => $Invoice, 'OutCome' => $OutCome, 'OpeningBalances' => $OpeningBalances, 'JournalSub' => $JournalSub, 'DepotStore' => $DepotStore, 'credorders' => $credorders, 'depiteOrder' => $depiteOrder, 'falagesale' => $falagesale, 'falagpurches' => $falagpurches, 'falagsandat' => $falagsandat, 'code' => $data[1], 'name' => $data[2]]);
    }

    public function Repotcustomers()
    {
        session()->put('page', 'Report');
        $customers = Customer::where('status', 1)
            ->where('orgID', auth()->user()->orgID)
            ->get();
        return view('admin.report.Allreport.customers', ['customers' => $customers]);
    }

    public function Repotcredorders()
    {
        session()->put('page', 'Report');
        $orders = Credorder::where('status', 1)
            ->where('orgID', auth()->user()->orgID)
            ->where('created_at', '>=', session('dateFrom'))
            ->where('created_at', '<', session('dateTo'))
            ->get();
        return view('admin.report.Allreport.Repotcredorders')->with('orders', $orders);
    }

    public function Repotoutcomes()
    {
         session()->put('page', 'Report');

        $outcomes =Expenses::where('status',1)->where('orgID', auth()->user()->orgID)->where('type',2)->get();
       
        return view('admin.report.Allreport.Repotoutcomes')->with('outcomes', $outcomes);
    }

    public function Repotsuppliers()
    {
        session()->put('page', 'Report');
        $suppliers = Supplier::where('status', 1)
            ->where('orgID', auth()->user()->orgID)
            ->get();
        return view('admin.report.Allreport.Repotsuppliers')->with('suppliers', $suppliers);
    }

    public function Repotpurchases()
    {
        session()->put('page', 'Report');
        $purchases = Purchase::where('kind', 2)
            ->where('orgID', auth()->user()->orgID)
           
            ->get();
        // dd( $purchases );
        return view('admin.report.Allreport.Repotpurchases', ['purchases' => $purchases]);
    }

    public function Repotdebitorder()
    {
        session()->put('page', 'Report');
        $orders = Debitorder::where('orgID', auth()->user()->orgID)
            ->where('status', 1)
            ->get();
        return view('admin.report.Allreport.Repotdebitorder')->with('orders', $orders);
    }

    public function Reportproducts($id, $store)
    {
        $data = explode('::', $store);

        try {
            if ($data[0] == -1 && $data[1] == -1) {
                $items = Product::where('barcode', $id)
                    ->where('status', 1)
                    ->where('orgID', auth()->user()->orgID)
                    ->first();
                $stock = Stock::where('orgID', auth()->user()->orgID)
                    ->where('productID', $items->id)
                    ->get();
                session()->put('page', 'Report');
                return view('admin.report.Allreport.Reportproducts')->with('stocks', $stock);
            } else {
                //  dd($data);
                $items = Product::where('barcode', $id)
                    ->where('status', 1)
                    ->where('orgID', auth()->user()->orgID)
                    ->first();
                $dept = DepotStore::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', $data[1])
                    ->first();
                $stock = Stock::where('orgID', auth()->user()->orgID)
                    ->where('productID', $items->id)
                    ->where('depotID', $dept->id)
                    ->get();
                return view('admin.report.Allreport.Reportproducts')->with('stocks', $stock);
            }
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function prodcategories()
    {
        session()->put('page', 'Report');
        $prodcategories = Prodcategory::where('status', 1)
            ->where('orgID', auth()->user()->orgID)
            ->get();
        return view('admin.report.Allreport.prodcategories')->with('prodcategories', $prodcategories);
    }

    public function AccountingGuide()
    {
        session()->put('page', 'Report');
        $AccountingGuide = Accounting_guide::where('orgID', auth()->user()->orgID)->get();
        return view('admin.report.Allreport.AccountingGuide')->with('AccountingGuide', $AccountingGuide);
    }

    public function Repotjournals()
    {
        session()->put('page', 'Report');
        $Journal = Journal::where('orgID', auth()->user()->orgID)->get();
        return view('admin.report.Allreport.Repotjournals')->with('Journal', $Journal);
    }

    public function RepotBalances()
    {
        session()->put('page', 'Report');
        $OpeningBalances = OpeningBalances::where('orgID', auth()->user()->orgID)->get();
        return view('admin.report.Allreport.RepotBalances')->with('OpeningBalances', $OpeningBalances);
    }

    public function RepotBank()
    {
        session()->put('page', 'Report');
        $Bank = Bank::where('orgID', auth()->user()->orgID)->get();
        return view('admin.report.Allreport.RepotBank')->with('Bank', $Bank);
    }

    public function RepotTreasury()
    {
        session()->put('page', 'Report');
        $Treasury = Treasury::where('orgID', auth()->user()->orgID)->get();
        return view('admin.report.Allreport.RepotTreasury')->with('Treasury', $Treasury);
    }

    public function Balancesheet()
    {
        session()->put('page', 'Report');

        $Origins = Accounting_guide::where('AccountID', 'like', '1%')
            ->where('orgID', auth()->user()->orgID)
            ->orderBy('AccountID')
            ->get();
        $Opponents = Accounting_guide::where('AccountID', 'like', '2%')
            ->where('orgID', auth()->user()->orgID)
            ->orderBy('AccountID')
            ->get();
        $capital = Accounting_guide::where('AccountID', 'like', '3%')
            ->where('orgID', auth()->user()->orgID)
            ->orderBy('AccountID')
            ->get();

        return view('admin.report.Allreport.Balancesheet', ['Origins' => $Origins, 'Opponents' => $Opponents, 'capital' => $capital]);
    }

    public function incomelist()
    {
        session()->put('page', 'Report');
        //   $Outcome =Outcomecategory::all();
        // $Sub =JournalSub::
        //  $Sub  =JournalSub::groupBy('CodeAccount')->where('CodeAccount','like' ,'4%')->where('orgID',auth()->user()->orgID)->selectRaw('sum(Debit) as sumIn ,sum(Credit) as sumout,CodeAccount,nameAccount')->get();
        //  DD(  $Sub  );
        //   dd( $Outcome[0]->outcomes->sum('total'));
        $income = Accounting_guide::where('AccountID', 'like', '4%')
            ->where('orgID', auth()->user()->orgID)
            ->orderBy('AccountID')
            ->get();
        $Expenses = Accounting_guide::where('AccountID', 'like', '5%')
            ->where('orgID', auth()->user()->orgID)
            ->orderBy('AccountID')
            ->get();
        return view('admin.report.Allreport.incomelist', ['income' => $income, 'Expenses' => $Expenses]);
    }

    public function TrialBalance()
    {
        session()->put('page', 'Report');
        $data = [];
        $TrialBalance = Accounting_guide::where('orgID', auth()->user()->orgID)
            ->orderBy('AccountID')
            ->get();
        return view('admin.report.Allreport.TrialBalance', ['TrialBalance' => $TrialBalance]);
    }

    public function Ledger()
    {
        session()->put('page', 'Report');
        $TrialBalance = Accounting_guide::where('orgID', auth()->user()->orgID)
            ->orderBy('AccountID')
            ->get();
        return view('admin.report.Allreport.Ledger', ['TrialBalance' => $TrialBalance]);
    }

    public function Manufactur()
    {
        session()->put('page', 'Report');
        $Manufactur = Manufactur::where('branchID', auth()->user()->branchID)
            ->orderBy('id', 'DESC')
            ->get();
        return view('admin.report.Allreport.Manufactur', ['Manufactur' => $Manufactur]);
    }

    public function salesfatorah()
    {
        $inv = Order::where('nadel', null)
            ->where('orgID', auth()->user()->orgID)
            ->get();
        $inv1 = OrderInv::where('TypeInv', 2)
            ->where('orgID', auth()->user()->orgID)
            ->get();
        $data = $inv->merge($inv1)->sortByDesc('created_at');

        return view('admin.report.Allreport.salesfatorah', ['orders' => $data]);
    }

       public function TaxReturns($id)
    {
        $data = date('Y');

        session()->put('page', 'Report');
        if ($id == 1) {
            $Purchase = Purchase::where('status', 1)
                ->where('invoiceDate', '>=', $data . '-1-1')
                ->where('invoiceDate', '<', $data . '-3-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('kind', 2)
                ->get();
            $sales1 = Order::where('created_at', '>=', $data . '-1-1')
                ->where('created_at', '<', $data . '-3-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('nadel', null)
                ->get();

            $sales2 = OrderInv::where('created_at', '>=', $data . '-1-1')
                ->where('created_at', '<', $data . '-3-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('TypeInv', 2)
                ->get();
            $sales = $sales1->merge($sales2);
            $credorders = Credorder::where('status', 1)
                ->where('created_at', '>=', $data . '-1-1')
                ->where('created_at', '<', $data . '-3-31')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $depiteOrder = Debitorder::where('status', 1)
                ->where('created_at', '>=', $data . '-1-1')
                ->where('created_at', '<', $data . '-3-31')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $Expenses = Expenses::where('status', 1)
                ->where('created_at', '>=', $data . '-1-1')
                ->where('created_at', '<', $data . '-3-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 2)
                ->get();

            return view('admin.report.Allreport.TaxReturns', ['sales' => $sales, 'Purchase' => $Purchase, 'from' => '2023-1-1', 'to' => '2023-3-31', 'id' => $id, 'credorders' => $credorders, 'depiteOrder' => $depiteOrder, 'Expenses' => $Expenses]);
        } elseif ($id == 2) {
            $Purchase = Purchase::where('status', 1)
                ->where('invoiceDate', '>=', $data . '-4-1')
                ->where('invoiceDate', '<', $data . '-6-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('kind', 2)
                ->get();
            $sales1 = Order::where('created_at', '>=', $data . '-4-1')
                ->where('created_at', '<', $data . '-6-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('nadel', null)
                ->get();
            $sales2 = OrderInv::where('created_at', '>=', $data . '-4-1')
                ->where('created_at', '<', $data . '-6-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('TypeInv', 2)
                ->get();
            $sales = $sales1->merge($sales2);

            $credorders = Credorder::where('status', 1)
                ->where('created_at', '>=', $data . '-4-1')
                ->where('created_at', '<', $data . '-6-30')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $depiteOrder = Debitorder::where('status', 1)
                ->where('created_at', '>=', $data . '-4-1')
                ->where('created_at', '<', $data . '-6-30')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $Expenses = Expenses::where('status', 1)
                ->where('created_at', '>=', $data . '-4-1')
                ->where('created_at', '<', $data . '-6-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 2)
                ->get();
            return view('admin.report.Allreport.TaxReturns', ['sales' => $sales, 'Purchase' => $Purchase, 'from' => '2023-4-1', 'to' => '2023-6-30', 'id' => $id, 'credorders' => $credorders, 'depiteOrder' => $depiteOrder, 'Expenses' => $Expenses]);
        } elseif ($id == 3) {
            $Purchase = Purchase::where('status', 1)
                ->where('invoiceDate', '>=', $data . '-7-1')
                ->where('invoiceDate', '<', $data . '-9-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('kind', 2)
                ->get();
            $sales1 = Order::where('created_at', '>=', $data . '-7-1')
                ->where('created_at', '<', $data . '-9-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('nadel', null)
                ->get();
            $sales2 = OrderInv::where('created_at', '>=', $data . '-7-1')
                ->where('created_at', '<', $data . '-9-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('TypeInv', 2)
                ->get();
            $sales = $sales1->merge($sales2);
            $credorders = Credorder::where('status', 1)
                ->where('created_at', '>=', $data . '-7-1')
                ->where('created_at', '<', $data . '-9-30')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $depiteOrder = Debitorder::where('status', 1)
                ->where('created_at', '>=', $data . '-7-1')
                ->where('created_at', '<', $data . '-9-30')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $Expenses = Expenses::where('status', 1)
                ->where('created_at', '>=', $data . '-7-1')
                ->where('created_at', '<', $data . '-9-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 2)
                ->get();

            return view('admin.report.Allreport.TaxReturns', ['sales' => $sales, 'Purchase' => $Purchase, 'from' => '2023-7-1', 'to' => '2023-9-30', 'id' => $id, 'credorders' => $credorders, 'depiteOrder' => $depiteOrder, 'Expenses' => $Expenses]);
        } elseif ($id == 4) {
            $Purchase = Purchase::where('status', 1)
                ->where('invoiceDate', '>=', $data . '-10-1')
                ->where('invoiceDate', '<', $data . '-12-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('kind', 2)
                ->get();
            $sales1 = Order::where('created_at', '>=', $data . '-10-1')
                ->where('created_at', '<', $data . '-12-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('nadel', null)
                ->get();
            $sales2 = OrderInv::where('created_at', '>=', $data . '-10-1')
                ->where('created_at', '<', $data . '-12-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('TypeInv', 2)
                ->get();
            $sales = $sales1->merge($sales2);
            $credorders = Credorder::where('status', 1)
                ->where('created_at', '>=', $data . '-10-1')
                ->where('created_at', '<', $data . '-12-31')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $depiteOrder = Debitorder::where('status', 1)
                ->where('created_at', '>=', $data . '-10-1')
                ->where('created_at', '<', $data . '-12-31')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $Expenses = Expenses::where('status', 1)
                ->where('created_at', '>=', $data . '-10-1')
                ->where('created_at', '<', $data . '-12-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 2)
                ->get();

            return view('admin.report.Allreport.TaxReturns', ['sales' => $sales, 'Purchase' => $Purchase, 'from' => '2023-10-1', 'to' => '2023-12-31', 'id' => $id, 'credorders' => $credorders, 'depiteOrder' => $depiteOrder, 'Expenses' => $Expenses]);
        }
    }

    public function TaxReturnsAjax(Request $request)
    {
        if ($request->id == 1) {
            $Purchase = Purchase::where('status', 1)
                ->where('invoiceDate', '>=', $request->select . '-1-1')
                ->where('invoiceDate', '<', $request->select . '-3-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('kind', 2)
                ->get();
            $sales1 = Order::where('created_at', '>=', $request->select . '-1-1')
                ->where('created_at', '<', $request->select . '-3-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('nadel', null)
                ->get();
            $sales2 = OrderInv::where('created_at', '>=', $request->select . '-1-1')
                ->where('created_at', '<', $request->select . '-3-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('TypeInv', 2)
                ->get();
            $sales = $sales1->merge($sales2);
            $credorders = Credorder::where('created_at', '>=', $request->select . '-1-1')
                ->where('created_at', '<', $request->select . '-3-31')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $depiteOrder = Debitorder::
                  where('created_at', '>=', $request->select . '-1-1')
                ->where('created_at', '<', $request->select . '-3-31')
                ->where('orgID', auth()->user()->orgID)
                ->get();
                $Expenses = Expenses::where('status', 1)
                ->where('created_at', '>=', $request->select . '-1-1')
                ->where('created_at', '<', $request->select . '-3-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 2)
                ->get();

            $saletotal = $sales->sum('totaldis');
            $credorderstotal= $credorders->sum('totaldis');
            $purcheltotal = $Purchase->sum('totaldis');
            $depiteOrdertotal= $depiteOrder->sum('totaldis');
            $salestax = $sales->sum('totalvat') ;
            $credorderstax= $credorders->sum('totalvat');
            $purcheltax = $Purchase->sum('totalvat');
            $depiteOrdertax= $depiteOrder->sum('totalvat');
            $Expensestotal= $Expenses->sum('total');
            $Expensestax= $Expenses->sum('vat');

            return response()->json(['salesval' => $saletotal,'credtotal' => $credorderstotal,'Purchaseval' => $purcheltotal,'depittotal' => $depiteOrdertotal,

            'salestax' => $salestax, 'credordtax' => $credorderstax, 'Purchasetax' => $purcheltax,'depittax' => $depiteOrdertax,'expentotal' => $Expensestotal ,'expentax' =>$Expensestax], 200);


        } elseif ($request->id == 2) {
            $Purchase = Purchase::where('status', 1)
                ->where('invoiceDate', '>=', $request->select . '-4-1')
                ->where('invoiceDate', '<', $request->select . '-6-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('kind', 2)
                ->get();
            $sales1 = Order::where('created_at', '>=', $request->select . '-4-1')
                ->where('created_at', '<', $request->select . '-6-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('nadel', null)
                ->get();
            $sales2 = OrderInv::where('created_at', '>=', $request->select . '-4-1')
                ->where('created_at', '<', $request->select . '-6-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('TypeInv', 2)
                ->get();
            $sales = $sales1->merge($sales2);
            $credorders = Credorder::where('created_at', '>=', $request->select . '-4-1')
                ->where('created_at', '<', $request->select . '-6-30')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $depiteOrder = Debitorder::
                where('created_at', '>=', $request->select . '-4-1')
                ->where('created_at', '<', $request->select . '-6-30')
                ->where('orgID', auth()->user()->orgID)
                ->get();

                $Expenses = Expenses::where('status', 1)
                ->where('created_at', '>=', $request->select . '-4-1')
                ->where('created_at', '<', $request->select . '-6-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 2)
                ->get();

            $saletotal = $sales->sum('totaldis');
            $credorderstotal= $credorders->sum('totaldis');
            $purcheltotal = $Purchase->sum('totaldis');
            $depiteOrdertotal= $depiteOrder->sum('totaldis');
            $salestax = $sales->sum('totalvat') ;
            $credorderstax= $credorders->sum('totalvat');
            $purcheltax = $Purchase->sum('totalvat');
            $depiteOrdertax= $depiteOrder->sum('totalvat');
            $Expensestotal= $Expenses->sum('total');
            $Expensestax= $Expenses->sum('vat');

            return response()->json(['salesval' => $saletotal,'credtotal' => $credorderstotal,'Purchaseval' => $purcheltotal,'depittotal' => $depiteOrdertotal,

            'salestax' => $salestax, 'credordtax' => $credorderstax, 'Purchasetax' => $purcheltax,'depittax' => $depiteOrdertax,'expentotal' => $Expensestotal ,'expentax' =>$Expensestax], 200);
        } elseif ($request->id == 3) {
            $Purchase = Purchase::where('status', 1)
                ->where('invoiceDate', '>=', $request->select . '-7-1')
                ->where('invoiceDate', '<', $request->select . '-9-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('kind', 2)
                ->get();
            $sales1 = Order::where('created_at', '>=', $request->select . '-7-1')
                ->where('created_at', '<', $request->select . '-9-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('nadel', null)
                ->get();
            $sales2 = OrderInv::where('created_at', '>=', $request->select . '-7-1')
                ->where('created_at', '<', $request->select . '-9-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('TypeInv', 2)
                ->get();
            $sales = $sales1->merge($sales2);
            $credorders = Credorder::where('created_at', '>=', $request->select . '-7-1')
                ->where('created_at', '<', $request->select . '-9-30')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $depiteOrder = Debitorder::where('created_at', '>=', $request->select . '-7-1')
                ->where('created_at', '<', $request->select . '-9-30')
                ->where('orgID', auth()->user()->orgID)
                ->get();
                $Expenses = Expenses::where('status', 1)
                ->where('created_at', '>=', $request->select . '-7-1')
                ->where('created_at', '<', $request->select .'-9-30')
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 2)
                ->get();

                $saletotal = $sales->sum('totaldis');
                $credorderstotal= $credorders->sum('totaldis');
                $purcheltotal = $Purchase->sum('totaldis');
                $depiteOrdertotal= $depiteOrder->sum('totaldis');
                $salestax = $sales->sum('totalvat') ;
                $credorderstax= $credorders->sum('totalvat');
                $purcheltax = $Purchase->sum('totalvat');
                $depiteOrdertax= $depiteOrder->sum('totalvat');
                $Expensestotal= $Expenses->sum('total');
                $Expensestax= $Expenses->sum('vat');

                return response()->json(['salesval' => $saletotal,'credtotal' => $credorderstotal,'Purchaseval' => $purcheltotal,'depittotal' => $depiteOrdertotal,

                'salestax' => $salestax, 'credordtax' => $credorderstax, 'Purchasetax' => $purcheltax,'depittax' => $depiteOrdertax,'expentotal' => $Expensestotal ,'expentax' =>$Expensestax], 200);
        } elseif ($request->id == 4) {
            $Purchase = Purchase::where('status', 1)
                ->where('invoiceDate', '>=', $request->select . '-10-1')
                ->where('invoiceDate', '<', $request->select . '-12-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('kind', 2)
                ->get();
            $sales1 = Order::where('created_at', '>=', $request->select . '-10-1')
                ->where('created_at', '<', $request->select . '-12-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('nadel', null)
                ->get();
            $sales2 = OrderInv::where('created_at', '>=', $request->select . '-10-1')
                ->where('created_at', '<', $request->select . '-12-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('TypeInv', 2)
                ->get();
            $sales = $sales1->merge($sales2);
            $credorders = Credorder::where('created_at', '>=', $request->select . '-10-1')
                ->where('created_at', '<', $request->select . '-12-31')
                ->where('orgID', auth()->user()->orgID)
                ->get();
            $depiteOrder = Debitorder::where('created_at', '>=', $request->select . '-10-1')
                ->where('created_at', '<', $request->select . '-12-31')
                ->where('orgID', auth()->user()->orgID)
                ->get();

                $Expenses = Expenses::where('status', 1)
                ->where('created_at', '>=', $request->select . '-10-1')
                ->where('created_at', '<', $request->select . '-12-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('type', 2)
                ->get();

                $saletotal = $sales->sum('totaldis');
                $credorderstotal= $credorders->sum('totaldis');
                $purcheltotal = $Purchase->sum('totaldis');
                $depiteOrdertotal= $depiteOrder->sum('totaldis');
                $salestax = $sales->sum('totalvat') ;
                $credorderstax= $credorders->sum('totalvat');
                $purcheltax = $Purchase->sum('totalvat');
                $depiteOrdertax= $depiteOrder->sum('totalvat');
                $Expensestotal= $Expenses->sum('total');
                $Expensestax= $Expenses->sum('vat');

                return response()->json(['salesval' => $saletotal,'credtotal' => $credorderstotal,'Purchaseval' => $purcheltotal,'depittotal' => $depiteOrdertotal,

                'salestax' => $salestax, 'credordtax' => $credorderstax, 'Purchasetax' => $purcheltax,'depittax' => $depiteOrdertax,'expentotal' => $Expensestotal ,'expentax' =>$Expensestax], 200);
        }
    }

    public function ReportALLproducts()
    {
        session()->put('page', 'Report');
        $products = Product::where('status', '!=', 5)
            ->where('orgID', auth()->user()->orgID)
            ->get();

        return view('admin.report.Allreport.ReportALLproducts')->with('products', $products);
    }

    public function ReportSandatReceive()
    {
        session()->put('page', 'Report');

        $invoices = Invoice::where('status', 1)
            ->where('orgID', auth()->user()->organization->id)
            ->where('type', 1)
            ->where('created_at', '>=', session('dateFrom'))
            ->where('created_at', '<', session('dateTo'))
            ->get();
        // dd(  $invoices[0]->customer->name );

        return view('admin.report.Allreport.ReportSandatReceive')->with('invoices', $invoices);
    }

    public function ReportSandatDeliver()
    {
        session()->put('page', 'Report');

        $invoices = Invoice::where('status', 1)
            ->where('orgID', auth()->user()->organization->id)
            ->where('type', 2)
            ->where('created_at', '>=', session('dateFrom'))
            ->where('created_at', '<', session('dateTo'))
            ->get();
        // dd(  $invoices[0]->customer->name );

        return view('admin.report.Allreport.ReportSandatDeliver')->with('invoices', $invoices);
    }

    public function Damagedproducts(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'AccountSelect' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        session()->put('page', 'Report');
        $data = explode('::', $request->AccountSelect);
        try {
            if ($data[0] == -1 && $data[1] == -1) {
                $Tainted = TaintedDetail::where('orgID', auth()->user()->orgID)
                    ->whereDate('dateTan', '<=', $request->to)
                    ->whereDate('dateTan', '>', $request->from)
                    ->get();
                return view('admin.report.Allreport.Damagedproducts')->with('Tainted', $Tainted)->with('store', 'all');
            } else {
                $dept1 = DepotStore::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', $data[1])
                    ->first();
                $Tainted = TaintedDetail::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', $dept1->id)
                    ->whereDate('dateTan', '<=', $request->to)
                    ->whereDate('dateTan', '>', $request->from)
                    ->get();
                return view('admin.report.Allreport.Damagedproducts')
                    ->with('Tainted', $Tainted)
                    ->with('store', $data[2]);
            }
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function showpredectdetail($id)
    {
        $product = Product::findorFail($id);
        $dept = DepotStore::where('orgID', auth()->user()->orgID)->get();
        return view('admin.report.smallShow.detailprodect')->with('product', $product)->with('dept', $dept);
    }

    public function processprdect($id)
    {
        $product = Product::findorFail($id);
        return view('admin.report.smallShow.processprodect')->with('product', $product);
    }

    public function supplierShow($id)
    {
        $supplier = Supplier::findorFail($id);
        //  dd( $supplier->Invoice);
        $jou = null;
        if ($supplier->AccountID != null) {
            $jou = JournalSub::where('orgID', auth()->user()->orgID)
                ->where('CodeAccount', $supplier->AccountID)
                ->get();
        }
        return view('admin.report.smallShow.supplierShow')->with('supplier', $supplier)->with('JournalSub', $jou);
    }

    public function customersShow($id)
    {
        $customer = Customer::findorFail($id);
        //  dd( $supplier->Invoice);
        $jou = null;
        if ($customer->AccountID != null) {
            $jou = JournalSub::where('orgID', auth()->user()->orgID)
                ->where('CodeAccount', $customer->AccountID)
                ->get();
        }
        return view('admin.report.smallShow.customersShow')->with('customer', $customer)->with('JournalSub', $jou);
    }

    public function Arrangement()
    {
        session()->put('page', 'Report');
        $Tainted = Arrangement::where('status', 1)
            ->where('orgID', auth()->user()->orgID)
            ->orderBy('id', 'DESC')
            ->get();
        return view('admin.report.Allreport.Arrangement')->with('Tainted', $Tainted);
    }

    public function OpenStoreRoeport(Request $request)
    {
        $this->validate($request, [
            'AccountSelect' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);
        try {
            session()->put('page', 'Report');
            $data = explode('::', $request->AccountSelect);

            if ($data[0] == -1 && $data[1] == -1) {
                $OpenStore = Stockinoutdetails::where('orgID', auth()->user()->orgID)
                    ->whereDate('created_at', '<=', $request->to)
                    ->whereDate('created_at', '>', $request->from)
                    ->get();
                return view('admin.report.Allreport.OpenStoreRoeport')
                    ->with('OpenStore', $OpenStore)
                    ->with('store', $data[2]);
            } else {
                $dept = DepotStore::where('orgID', auth()->user()->orgID)
                    ->where('AccountID', $data[1])
                    ->first();
                $OpenStore = Stockinoutdetails::where('orgID', auth()->user()->orgID)
                    ->where('depotID', $dept->id)
                    ->whereDate('created_at', '<=', $request->to)
                    ->whereDate('created_at', '>', $request->from)
                    ->get();
                return view('admin.report.Allreport.OpenStoreRoeport')
                    ->with('OpenStore', $OpenStore)
                    ->with('store', $data[2]);
            }
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function StoreConversionRoeport(Request $request)
    {
        $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
        ]);
        try {
            //  dd($request->all());

            session()->put('page', 'Report');
            $from = explode('::', $request->from);
            $to = explode('::', $request->to);
            // $Tainted =TaintedDetail::where('orgID',auth()->user()->orgID)->where('AccountID',$data[1])->where('dateTan','>=',$request->from)->where('dateTan','<',$request->to)->get();
            $dept1 = DepotStore::where('orgID', auth()->user()->orgID)
                ->where('AccountID', $from[1])
                ->first();
            $dept2 = DepotStore::where('orgID', auth()->user()->orgID)
                ->where('AccountID', $to[1])
                ->first();

            $StoreConversion = IncomTransfers::where('orgID', auth()->user()->orgID)
                ->where('branchOne', $dept1->id)
                ->where('branchTow', $dept2->id)
                ->whereDate('dateCon', '<=', $request->datato)
                ->whereDate('dateCon', '>', $request->datafrom)
                ->get();
            // dd(    $StoreConversion->all());
            // $Tainted =Stockinoutdetails::where('orgID',auth()->user()->orgID)->where('depotID', $dept->id)->->get();
            return view('admin.report.Allreport.StoreConversionRoeport')
                ->with('StoreConversion', $StoreConversion)
                ->with('Store1', $from[2])
                ->with('Store2', $to[2]);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function HangeStore(Request $request)
    {
        $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
        ]);
        try {
            session()->put('page', 'Report');
            $from = explode('::', $request->from);
            $to = explode('::', $request->to);
            // $Tainted =TaintedDetail::where('orgID',auth()->user()->orgID)->where('AccountID',$data[1])->where('dateTan','>=',$request->from)->where('dateTan','<',$request->to)->get();
            $dept1 = DepotStore::where('orgID', auth()->user()->orgID)
                ->where('AccountID', $from[1])
                ->first();
            $dept2 = DepotStore::where('orgID', auth()->user()->orgID)
                ->where('AccountID', $to[1])
                ->first();

            $StoreConversion = StoreConversion::where('orgID', auth()->user()->orgID)
                ->where('branchOne', $dept1->id)
                ->where('branchTow', $dept2->id)
                ->whereDate('dateCon', '>', $request->datafrom)
                ->whereDate('dateCon', '<=', $request->datato)
                ->get();
            // dd(    $StoreConversion->all());
            // $Tainted =Stockinoutdetails::where('orgID',auth()->user()->orgID)->where('depotID', $dept->id)->->get();
            return view('admin.report.Allreport.HangeStore')
                ->with('StoreConversion', $StoreConversion)
                ->with('Store1', $from[2])
                ->with('Store2', $to[2]);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function CustomerbalanceRoeport()
    {
        try {
            $TrialBalance = Accounting_guide::where('orgID', auth()->user()->orgID)
                ->where('SourceID', '124')
                ->get();
            return view('admin.report.Allreport.TrialBalance', ['TrialBalance' => $TrialBalance]);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function suppliersbalanceRoeport()
    {
        try {
            $TrialBalance = Accounting_guide::where('orgID', auth()->user()->orgID)
                ->where('SourceID', '221')
                ->get();
            return view('admin.report.Allreport.TrialBalance', ['TrialBalance' => $TrialBalance]);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function Purchproduct(Request $request)
    {
        try {
            //    dd($request->all());

            $this->validate($request, [
                'sername' => 'required',
                'from' => 'required',
                'to' => 'required',
            ]);

            $data = explode('-', $request->sername);
            $items = Product::where('barcode', $data[1])
                ->where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->first();

            $purch = Purchasedetails::where('productID', $items->id)
                ->where('kind', 2)
                ->whereDate('created_at', '>=', $request->from)
                ->whereDate('created_at', '<', $request->to)
                ->get();

            //dd(  $items);
            return view('admin.report.Allreport.Purchproduct', ['purch' => $purch, 'items' => $items]);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function ProdectSale(Request $request)
    {
        try {
            // dd( $request->all());

            $data = explode('-', $request->nameProdectSale);
            $items = Product::where('barcode', $data[1])
                ->where('status', 1)
                ->where('orgID', auth()->user()->orgID)
                ->first();

            $stock = Stock::where('orgID', auth()->user()->orgID)
                ->where('productID', $items->id)
                ->whereDate('created_at', '>', $request->from)
                ->whereDate('created_at', '<=', $request->to)
                ->where('kind', 7)
                ->get();
            session()->put('page', 'Report');
            return view('admin.report.Allreport.ProdectSale')->with('stocks', $stock);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function TableReport()
    {
        try {
            // dd( $request->all());
            $tbls = Tbl::where('status', 1)
                ->where('branchID', auth()->user()->branchID)
                ->get();
            session()->put('page', 'Report');
            return view('admin.report.Allreport.TableReport')->with('tbls', $tbls);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function ShowTableReport($id)
    {
        try {
            // dd( $request->all());
            $Order1 = Order::where('orgID', auth()->user()->orgID)
                ->where('tblNo', $id)
                ->where('TypeInv', 2)
                ->get();
            $Order2 = OrderInv::where('orgID', auth()->user()->orgID)
                ->where('tblNo', $id)
                ->where('TypeInv', 2)
                ->get();
            $Order = $Order1->merge($Order2);
            session()->put('page', 'Report');
            return view('admin.report.smallShow.ShowTableReport')->with('orders', $Order);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function TodayOrder(Request $request)
    {
        try {
            $sales1 = Orderdetails::whereDate('created_at', $request->from)
                ->where('orgID', auth()->user()->orgID)
                ->where('kind', 2)
                ->get();
            $sales2 = OrderinvDetails::whereDate('created_at', $request->from)
                ->where('orgID', auth()->user()->orgID)
                ->where('kind', 2)
                ->get();
            $sales = $sales1->merge($sales2);

            return view('admin.report.Allreport.TodayOrder', ['sales' => $sales]);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function MonthOrder(Request $request)
    {
        try {
            $this->validate($request, [
                'from' => 'required',
            ]);

            //  dd( date("F", strtotime(date("Y-m-d")))  );

            $sales1 = Orderdetails::whereDate('created_at', '>', $request->from . '-1')
                ->whereDate('created_at', '<=', $request->from . '-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('kind', 2)
                ->get();
            $sales2 = OrderinvDetails::whereDate('created_at', '>', $request->from . '-1')
                ->whereDate('created_at', '<=', $request->from . '-31')
                ->where('orgID', auth()->user()->orgID)
                ->where('kind', 2)
                ->get();
            $sales = $sales1->merge($sales2);

            return view('admin.report.Allreport.MonthOrder', ['sales' => $sales]);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function Valuation(Request $request)
    {
        try {
            $data = explode('::', $request->AccountSelect);

            $dept = DepotStore::where('orgID', auth()->user()->orgID)
                ->where('AccountID', $data[1])
                ->first();
            $unit = ProdUnit::where('StoreId', $dept->id)
                ->groupBy('prodID')
                ->get();
            //  dd( date("F", strtotime(date("Y-m-d")))  );

            return view('admin.report.Allreport.Valuation', ['unit' => $unit]);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function CashierSales(Request $request)
    {
        try {
            $Order1 = Order::where('orgID', auth()->user()->orgID)
                ->where('userID', $request->AccountSelect)
                ->where('TypeInv', 2)
                ->get();
            $Order2 = OrderInv::where('orgID', auth()->user()->orgID)
                ->where('userID', $request->AccountSelect)
                ->where('TypeInv', 2)
                ->get();
            $Order = $Order1->merge($Order2);

            $user = 'كاشر';

            // $sales1 = Orderdetails::whereDate('created_at','>=',$request->from."-1")->whereDate('created_at','<',$request->from."-31")->where('orgID',auth()->user()->orgID)->where('kind',2)->get();
            // $sales2 = OrderinvDetails::whereDate('created_at','>=',$request->from."-1")->whereDate('created_at','<',$request->from."-31")->where('orgID',auth()->user()->orgID)->where('kind',2)->get();
            // $sales = $sales1->merge($sales2);

            //    dd(  $Order );

            return view('admin.report.Allreport.CashierSales', ['orders' => $Order, 'User' => $user]);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function NadelSales(Request $request)
    {
        try {
            $Order1 = Order::where('orgID', auth()->user()->orgID)
                ->where('userID', $request->AccountSelect)
                ->where('TypeInv', 2)
                ->get();
            $Order2 = OrderInv::where('orgID', auth()->user()->orgID)
                ->where('userID', $request->AccountSelect)
                ->where('TypeInv', 2)
                ->get();
            $Order = $Order1->merge($Order2);

            $user = 'نادل';

            // $sales1 = Orderdetails::whereDate('created_at','>=',$request->from."-1")->whereDate('created_at','<',$request->from."-31")->where('orgID',auth()->user()->orgID)->where('kind',2)->get();
            // $sales2 = OrderinvDetails::whereDate('created_at','>=',$request->from."-1")->whereDate('created_at','<',$request->from."-31")->where('orgID',auth()->user()->orgID)->where('kind',2)->get();
            // $sales = $sales1->merge($sales2);

            //    dd(  $Order );

            return view('admin.report.Allreport.CashierSales', ['orders' => $Order, 'User' => $user]);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function ShowInvoices(string $id)
    {
        //
        //   dd($id);

        try {
            $Order = Order::where('orgID', auth()->user()->orgID)
                ->where('serial', $id)
                ->where('TypeInv', 2)
                ->first();

            //  dd(  $Order);
            if ($Order == null) {
                $Order = OrderInv::where('orgID', auth()->user()->orgID)
                    ->where('serial', $id)
                    ->where('TypeInv', 2)
                    ->first();
            }
            return view('admin.report.smallShow.ShowInvoices')->with('order', $Order);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function MoreSalesProdect()
    {
        try {
            //  $Stock =DB::select('SELECT sum(quantityOut) as sumout, productID,comment FROM stockitems WHERE kind = "7" AND branchID ="'.auth()->user()->branchID.'" GROUP BY productID ORDER BY sum(quantityOut)  DESC' );

            // $Stock = Stock::groupBy('productID')
            //     ->where('kind', 7)
            //     ->where('branchID', auth()->user()->branchID)
            //     ->selectRaw('sum(quantityOut) as sumout ,productID ,comment ')
            //     ->orderByRaw('SUM(quantityOut) DESC')
            //     ->get();

            // $Stock = Product::where('status', '!=', 5)
            //     ->where('orgID', auth()->user()->orgID)
            //     ->get();
            $Stock =ProdUnit::where('orgID', auth()->user()->orgID)->orderBy('saller', 'DESC')->get();



            session()->put('page', 'Report');
            return view('admin.report.Allreport.MoreSalesProdect')->with('stocks', $Stock);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    // ---------------------------------------------------------------------------------------------------
    public function lessSalesProdect()
    {
        try {
            //  $Stock =DB::select('SELECT sum(quantityOut) as sumout, productID,comment FROM stockitems WHERE kind = "7" AND branchID ="'.auth()->user()->branchID.'" GROUP BY productID ORDER BY sum(quantityOut)  DESC' );

            $Stock = Stock::groupBy('productID')
                ->where('kind', 7)
                ->where('branchID', auth()->user()->branchID)
                ->selectRaw('sum(quantityOut) as sumout ,productID ,comment ')
                ->orderByRaw('SUM(quantityOut) ')
                ->get();
                // dd(   $Stock );

            session()->put('page', 'Report');
            return view('admin.report.Allreport.MoreSalesProdect')->with('stocks', $Stock);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function Profitability()
    {
        try {
            $Stock = ProdUnit::where('orgID', auth()->user()->orgID)
                ->groupBy('prodID')
                ->orderByRaw('saller DESC')
                ->get();
            session()->put('page', 'Report');
            return view('admin.report.Allreport.Profitability')->with('stocks', $Stock);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function OpeningStore()
    {
        try {
            $Stock = Stockinoutdetails::where('orgID', auth()->user()->orgID)->get();

            session()->put('page', 'Report');
            return view('admin.report.Allreport.OpeningStore')->with('stocks', $Stock);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function PriceProdect()
    {
        try {
            $prds = Product::where(function ($query) {
                $query->where('TypeProdect', 2)->Where('saleable', 1)->orWhere('TypeProdect', 1);
            })
                ->where('orgID', auth()->user()->orgID)
                ->get();

            session()->put('page', 'Report');
            return view('admin.report.Allreport.PriceProdect')->with('products', $prds);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function durationsSales()
    {
        try {
            $duration = Duration::where('branchID', auth()->user()->branchID)
                ->orderBy('id', 'desc')
                ->get();

            session()->put('page', 'Report');
            return view('admin.report.Allreport.durationsSales')->with('duration', $duration);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    public function ShowdurationsSales($id)
    {
        try {
            $data = Order::where('orgID', auth()->user()->orgID)
                ->where('durationID', $id)
                ->where('TypeInv', 2)
                ->get();
            session()->put('page', 'Report');
            return view('admin.report.smallShow.ShowdurationsSales')->with('orders', $data);
        } catch (Exception $e) {
            session()->flash('faild', 'حدث خطا في التقرير');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource. //   dd(  $Stock );
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
