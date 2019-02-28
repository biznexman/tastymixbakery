<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h5 class="modal-title">About Transfer</h5>
</div>


<div class="modal-body">
    
        <div class="form-group row">
            <div class="col-md-12 text-center bold-header">
                {{ $results['currency']." ".number_format(($results['amount']/100),0)." to ".$results['recipient']['name'] }} from {{ $results['currency'].' '.$results['source'] }}
            </div>
        </div>

        <div class="form-group row text-center">
            <div class="col-md-12">
                on {{ date('D jS, M Y hA', strtotime($results['createdAt'])) }}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <strong>Transfer Code: </strong>{{ $results['transfer_code'] }}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <strong>Transfer Ref: </strong>{{ $results['reference'] }}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <strong>Reason: </strong>{{ $results['reason'] }}
            </div>
        </div>
    
</div>


<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> Close</button>

</div>
