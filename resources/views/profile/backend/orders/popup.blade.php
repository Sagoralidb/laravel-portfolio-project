<!-- Modal -->
<div class="modal fade" id="exampleModalLong{{$orderInfo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title" id="exampleModalLongTitle">#{{$orderInfo->id}} | OrderBy : {{$orderInfo->user_id?$orderInfo->user_id:''}}-{{$orderInfo->user->name ? $orderInfo->user->name :'N/A'}} | Budget :{{$orderInfo->budget}}/-</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-info text-justify" style="word-wrap: break-word;white-space: 
        pre-wrap;overflow-wrap: break-word;">{{$orderInfo->title}}</div>
        <div class="modal-body text-info text-justify" style="word-wrap: break-word;white-space: 
        pre-wrap;overflow-wrap: break-word;">{!! $orderInfo->description !!}</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>