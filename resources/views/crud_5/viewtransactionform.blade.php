<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h3 class="modal-title">About Transaction</h3>
</div>


<div class="modal-body">
    
        <div class="form-group row">
            <div class="col-md-12 text-center bold-header">
                {{ $results['currency']." ".number_format(($results['amount']/100),0)." from ".$results['customer']['email'] }}
            </div>
        </div>

        <div class="form-group row text-center">
            <div class="col-md-12">
                on {{ date('D jS, M Y hA', strtotime($results['created_at'])) }}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <strong>Channel: </strong>{{ $results['channel'] }}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <strong>Transaction Ref: </strong>{{ $results['reference'] }}
            </div>
        </div>
    
</div>


<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> Close</button>

</div>
