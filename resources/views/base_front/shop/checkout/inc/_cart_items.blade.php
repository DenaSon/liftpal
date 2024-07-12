<div class="table-responsive-sm">

<div class="table-scroll">
    <table class="table-list">
        <thead>
        <tr>
            <th style="width: 10px" scope="col">#</th>
            <th scope="col">محصول</th>
            <th scope="col">
                عنوان
            </th>
            <th style="width: 60px" scope="col">قیمت واحد</th>
            <th style="width: 80px" scope="col">تعداد</th>
            <th style="width: 60px"  scope="col">مجموع</th>
            <th style="width: 60px"  scope="col">اقدامات</th>

        </tr>
        </thead>
        <tbody>
 @php
    $products = \App\Models\Product::whereIn('id', $items->pluck('product_id'))->get();
    $types = \App\Models\Type::whereIn('id', $items->pluck('type_id'))->get();
@endphp

@foreach($items as $index => $item)
    @php
        $product = $products->where('id', $item->product_id)->first();
        $type = $types->where('id', $item->type_id)->first();
        $slug = slugMaker($item->id);

    @endphp

    <tr id="tr-{{$item->id}}">
        <td class="table-serial">{{ $index + 1 }}</td>
        <td class="product-td-name center" style="text-align: center;width: 130px">
            <a href="{{ route('singleProduct', ['product' => $product, 'slug' => $slug]) }}">
                <b><img src="{{ asset($product->images()->first()->file_path ?? 'front/assets/images/coming-soon.png')  }}" class="" height="100" width="130" alt="Empty"> </b>
                
            </a>
        </td>
        <td style="width:150px">
            {{ $product->name }}
            <br>
            <span class="text-muted font-11">{{ $type->name  }}</span>  </td>
        <td class="table-vendor"><a href="#">{{ number_format($unitPrice[$item->id]) }}</a></td>
        <td class="table-vendor">
            <b> {{ $item->quantity }}</b>
        </td>
        <td class="table-vendor"><a href="">{{ number_format($unitPrice[$item->id] * $item->quantity) }}</a></td>

        <td class="table-action">
            <a class="view" href="{{ route('singleProduct', ['product' => $product, 'slug' => $slug]) }}" title="مشاهده سریع" ><i class="fas fa-eye"></i></a>
            <a data-value="{{$item->id}}" id="basket-trash-{{$item->id}}" class="trash" href="#" title="حذف از لیست"><i class="icofont-trash"></i></a>
        </td>

    </tr>


    <script>
        $(document).ready(function() {
            // Event listener for the trash icon click
            $('#basket-trash-{{$item->id}}').on('click', function(e) {
                e.preventDefault();

                // Get the data-value attribute inside the click event handler
                var itemId = $(this).data('value');


                // Show SweetAlert for confirmation
                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: 'این مورد را از سبد خرید خود حذف می کنید؟',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'بله، حذف کن!',
                    cancelButtonText: 'انصراف'
                }).then(function(result) {
                    // If the user clicks "OK" (confirm)
                    if (result.isConfirmed) {
                        $('#tr-' + itemId).hide(1200).css({
                            'background-color': '#f1a4a4',  // Replace with your desired background color
                            'color': '#f52c2c'  // Replace with your desired text color
                        });

                        // Make an AJAX request to your controller
                        $.ajax({
                            url: '{{ route('liveBasketDeleteItem') }}', // Replace with your actual controller URL
                            method: 'POST', // Use 'POST' or 'GET' based on your controller setup
                            data: { itemId: itemId },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },

                            success: function(response)
                            {


                                    $.ajax({
                                        type: 'GET',
                                        url: '{{ route('getCartInfo') }}',
                                        success: function(response)
                                        {

                                            // Update the quantity in the counter
                                            $('.totalQuantity').text(response.totalQuantity);
                                            var formattedPrices = parseFloat(response.totalPrices).toLocaleString('fa-IR');
                                            $('.totalPrices').text(formattedPrices);

                                        },
                                        error: function(error) {

                                        }
                                    });



                                Swal.fire({
                                    title: 'محصول از سبد خرید حذف شد',
                                    position: 'top-start',
                                    toast: true,
                                    icon: 'success',
                                    timer: 1250,
                                    showConfirmButton: false
                                });

                            },
                            error: function(error) {
                                // Handle errors if any
                                Swal.fire({
                                    toast: true,
                                    icon:'warning',
                                    position: 'top-start',
                                    showConfirmButton: false,
                                    timer: 850, // Adjust the duration of the toast
                                    title: 'Refresh...',
                                    timerProgressBar: true, // Enable progress bar


                                });
                                location.reload();
                            }
                        });
                    }
                });
            });
        });
    </script>





@endforeach

        </tbody>
    </table>
</div>
</div>
<br/>

<a class="btn btn-outline order-register-button" href="{{ route('checkout/cart',['level'=>'shipping']) }}"> ثبت سفارش </a>
