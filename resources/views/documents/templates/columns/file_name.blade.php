
@if ($row->media->count() > 0) 
@if ($row->media[0]->mime_type === 'image/jpeg' || $row->media[0]->mime_type=== 'image/png')
    <div class="d-flex align-items-center">
<span class="svg-icon svg-icon-2x svg-icon-primary me-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path opacity="0.3" d="M22 5V19C22 19.6 21.6 20 21 20H19.5L11.9 12.4C11.5 12 10.9 12 10.5 12.4L3 20C2.5 20 2 19.5 2 19V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5ZM7.5 7C6.7 7 6 7.7 6 8.5C6 9.3 6.7 10 7.5 10C8.3 10 9 9.3 9 8.5C9 7.7 8.3 7 7.5 7Z" fill="black"></path><path d="M19.1 10C18.7 9.60001 18.1 9.60001 17.7 10L10.7 17H2V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V12.9L19.1 10Z" fill="black"></path></svg></span>

    <div class="d-flex flex-column">
        <span>{{($row->media[0]->file_name)}}</span>
    </div>
</div>
@else
    <div class="d-flex align-items-center">
 <span class="svg-icon svg-icon-2x svg-icon-primary me-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="black"></path><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"></path></svg></span>
     <div class="d-flex flex-column">
         <span>{{($row->media[0]->file_name)}}</span>
     </div>
 </div>
@endif
@endif
