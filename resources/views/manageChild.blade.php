
    @foreach($childs as $child)
        @if ($child->Account_status ==0)
        <ul class="tree">
        @endif

            <li  @if ($child->Account_status ==0) class="tree-title" onclick="FunClickAccount({{ $child->AccountID }})"  @else class="tree-item" @endif > @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{ $child->AccountName }}  @else {{ $child->AccountNameEn }} @endif </li>

            @if(count($child->AccountingGuide)>0)
                    @include('manageChild',['childs' => $child->AccountingGuide])
            @endif

        @if ($child->Account_status ==0)
        </ul>
        @endif
    @endforeach





