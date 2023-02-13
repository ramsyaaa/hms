<script id="insuranceDiseaseTemplate" type="text/x-jsrender">
<tr>
    <td class="text-center item-number">1</td>
     <td>
        <input class="form-control disease-name" required="" name="disease_name[]" type="text" data-id="{{:uniqueId}}">
    </td>
    <td>
        <input class="form-control disease-charge price-input" required="" name="disease_charge[]" type="text">
    </td>
    </td>
    <td class="text-center">
    <a href="javascript:void(0)" title="{{__('messages.common.delete')}}"
                           class="delete-disease btn px-1 text-danger fs-3 pe-0">
                                <i class="fa-solid fa-trash"></i>
                        </a>
    </td>
</tr>


</script>
