<ul class="nav nav-tabs nav-fill" role="tablist">
    <li class="nav-item">
        <a href="#details" class="nav-link active" data-bs-toggle="tab" role="tab">
            <i class=" fi-align-right me-2"></i>
            توضیحات
        </a>
    </li>
    &nbsp;
    <li class="nav-item">
        <a href="#profile1" class="nav-link" data-bs-toggle="tab" role="tab">
            <i class="fi-plus-circle"></i>
            مشخصات فنی
        </a>
    </li>

</ul>

<!-- Tabs content -->
<div class="tab-content">
    <div class="tab-pane fade show active" id="details" role="tabpanel" style="line-height:40px;text-align: justify">

    {!! $product->details !!}

    </div>
    <div class="tab-pane fade" id="profile1" role="tabpanel">

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>

                    <th>عنوان</th>
                    <th>مقدار</th>

                </tr>
                </thead>
                <tbody>
                @foreach($product->properties as $property)
                    <tr>
                        <th scope="row">{{ $property->name }}</th>
                        <td>{{ $property->propertyValues->first()->value }}</td>

                    </tr>
                @endforeach



                </tbody>
            </table>
        </div>



    </div>


</div>
