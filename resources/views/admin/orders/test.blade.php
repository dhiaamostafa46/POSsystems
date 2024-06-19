
@extends('layouts.dashboard')
<style>
  td ,th {
    padding: 0px !important;
    text-align: center !important;
  }
</style>
@section('content')

<form>
<select name="txtProd" id="txtProd" class="livesearch form-control">

</select>
</form>
<script>
////////////////////////////////////////////////add by saeed/////////////////////////////////////////////////////
      $('.livesearch').select2({
        placeholder: 'أدخل إسم المنتج ',
        ajax: {
            url: '/prodByName',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nameAr+"-"+item.prodPrice,
                            id: item.id
                           
                        }
                    })
                };
            },
            cache: true
          }
      });
      
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

</script>
@endsection