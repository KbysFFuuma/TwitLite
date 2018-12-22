<!-- 設定変更 -->
<!-- <div class="row justify-content-center"> -->
    <!-- <div class="col-md-6"> -->
        <div class="card">
            <div class="card-header">{{ __('プロフィール変更') }}</div>

            <div class="card-body">
              @if (session('isChanged'))
                <p class="changedLabel">※プロフィールを変更しました</p>
              @endif
              @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
              @endif
                <form method="POST" action="/setting" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label for="userId" class="col-md-4 col-form-label text-md-right">{{ __('userId') }}</label>

                        <div class="col-md-6">
                            <input id="userId" type="text" class="form-control{{ $errors->has('userId') ? ' is-invalid' : '' }}" name="userId" value="{{ $userInfo->userId }}" required autofocus>

                            @if ($errors->has('userId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('userId') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $userInfo->name }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="profileText" class="col-md-4 col-form-label text-md-right">{{ __('Profile') }}</label>

                        <div class="col-md-6">
                            <input id="profileText" type="textarea" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $userInfo->name }}" required autofocus>
                            <textarea class ="" name=""  
                          value="{{ $userInfo->name }}" required autofocus></textarea>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="icon" class="col-md-4 col-form-label text-md-right">{{ __('icon') }}</label>

                        <div class="col-md-6">
                            <input id="icon" type="file" name="icon">
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4  text-md-right">
                            <button type="submit" class="btn btn-primary">
                                {{ __('変更する') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <!-- </div> -->
<!-- </div> -->
