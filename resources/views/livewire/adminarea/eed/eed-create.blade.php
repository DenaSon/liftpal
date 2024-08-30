<div>


    <div class="card border-0 shadow mt-2">
        <div class="card-body text-center">
            <div class="form-group">
                <label class="form-label w-25" for="type">عنوان تابلو</label>
                <input class="form-control" type="text" wire:model="type" id="type" placeholder="نوع تابلو فرمان:">
            </div>

            <div class="form-group mt-2">
                <label class="form-label w-25" for="type"> کد خطا</label>
                <input class="form-control" type="text" wire:model="code" id="type" placeholder="کد:">
            </div>

            <div class="mt-3">

                <button class="btn btn-primary" wire:click="storeCode">ثبت</button>

            </div>


        </div>
    </div>


    <div class="card border-0 shadow mt-2 mt-4">
        <div class="card-body">


            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نوع تابلو</th>
                        <th>  کد خطا</th>
                        <th>اقدامات</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($eedList as $index=> $error)
                    <tr wire:key="error-{{ $error->id }}">
                        <th scope="row">{{ $index +1 }}</th>
                        <td>{{ $error->type }}</td>
                        <td>{{ $error->code }}</td>
                        <td>
                         <a wire:confirm="از حذف خطا اطمینان دارید؟" href="#" wire:click="remove({{$error->id}})">   <i class="fi fi-trash me-4"></i></a>
                            <a href="#" wire:click="edit{{$error->id}}">  <i class="fi fi-edit text-warning"></i> </a>
                        </td>

                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $eedList->links() }}
            </div>



        </div>
    </div>







</div>
