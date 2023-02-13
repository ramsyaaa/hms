<script id="patientDiagnosisTestTemplate" type="text/x-jsrender">
<tr>
    <td class="text-center item-number">1</td>
     <td>
        <input class="form-control diagnosis-name" name="property_name[]" type="text" data-id="{{:uniqueId}}">
    </td>
    <td>
        <input class="form-control diagnosis-value" name="property_value[]" type="text">
    </td>
    </td>
    <td class="text-center">
    <a title="{{__('messages.common.delete')}}" href="javascript:void(0)"
       class="delete-diagnosis pointer btn-icon btn px-1 text-danger fs-3 pe-0">
        <i class="fa-solid fa-trash"></i>
    </a>
    </td>
</tr>
</script>
