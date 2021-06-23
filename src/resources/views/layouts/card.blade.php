<div class="col-md-6">
    <div class="my-4">
        <div class="card mx-auto w-100">
            <div class="card-header p-2 h5">
                <i class="fas fa-user m-2 font-weight-bold text-secondary"></i>
                <p class="d-inline font-weight-bold text-secondary">名前</p>
                <a href="/record" class="btn btn-secondary rounded-pill float-right">
                    <i class="far fa-edit mr-1"></i>詳細を見る
                </a>
            </div>
            <div class="card-body h6 bg-light mb-0">
                <dl class="row mb-4">
                    <dt class="col-5 text-right text-dark">最終来店日</dt>
                    <dd class="col-7">{{ NOW() }}</dd>
                </dl>
                <dl class="row">
                    <dt class="col-5 text-right text-dark">電話番号</dt>
                    <dd class="col-7">090-1234-5678</dd>
                </dl>
            </div>
        </div>
    </div>
</div>