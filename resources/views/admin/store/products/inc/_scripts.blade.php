<!-- Select2 js-->

<!-- Dropzone file uploads-->
<script src="{{ asset('admin/assets/libs/dropzone/min/dropzone.min.js') }}"></script>


<!-- Init js-->
<script src="{{ asset('admin/assets/js/pages/form-fileuploads.init.js') }}"></script>

<!-- Init js -->
<script src="{{ asset('admin/assets/js/pages/add-product.init.js') }}"></script>






<!-- Init js-->
<script src=" {{ asset('admin/assets/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>







<!-- select2-->
<script>
    $(document).ready(function() {

        $('.js-example-basic-single-supplier').select2({
            // Options go here
            placeholder: 'انتخاب تامین کننده ', // Placeholder text
            width: '100%',
            theme: "classic",
            tags:true
        });

        $('.js-example-basic-multiple').select2({
            // Options go here
            placeholder: 'انتخاب دسته های محصول', // Placeholder text
            width: '100%',
            theme: "classic"
        });

        $('.js-example-basic-multiple-subcategory').select2({
            // Options go here
            placeholder: 'انتخاب زیر دسته های محصول', // Placeholder text
            width: '100%',
            theme: "classic"
        });


        $('.js-example-basic-multiple-tags').select2({
            // Options go here
            placeholder: 'انتخاب برچسب های محصول', // Placeholder text
            tags:true,
            maximumSelectionLength: 4,
            width: '100%',
            theme: "classic",



        });

        $('.js-example-basic-single').select2({
            // Options go here
            placeholder: 'انتخاب برند محصول', // Placeholder text
            tags:true,
            maximumSelectionLength: 4,
            width: '100%',
            theme: "classic"


        });




    });

</script>

<!-- editor1-->
<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace('editor1', {
        language: 'fa', // Set the language to Persian

        // Other CKEditor configuration options
    });
</script>



<!-- calc price-->

<script>//calculate final price


    const priceInput = document.getElementById('product-price');
    const discountInput = document.getElementById('product-discount');
    const taxInput = document.getElementById('product-tax');
    const endPriceLabel = document.getElementById('EndPrice');

    // Add event listeners to the input fields
    priceInput.addEventListener('input', calculateEndPrice);
    discountInput.addEventListener('input', calculateEndPrice);
    taxInput.addEventListener('input', calculateEndPrice);

    // Function to calculate and update the end price
    function calculateEndPrice() {
        const price = parseFloat(priceInput.value) || 0;
        const discount = parseFloat(discountInput.value) || 0;
        const tax = parseFloat(taxInput.value) || 0;

        const endPrice = price * (1 - discount / 100) * (1 + tax / 100);
        // Format the end price in Iranian tooman
        const formattedEndPrice = endPrice.toLocaleString('fa-IR') + ' تومان';

        endPriceLabel.textContent = `قیمت نهایی: ${formattedEndPrice}`;

    }



</script>





<!-- uploads-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.querySelector('.custom-file-input');
        const fileLabel = document.querySelector('.custom-file-label');
        const selectedFilenames = document.querySelector('.selected-filenames');

        fileInput.addEventListener('change', function() {
            const files = Array.from(this.files);
            const filenames = files.map(file => file.name).join(', ');
            fileLabel.textContent = filenames;
            selectedFilenames.textContent = 'Selected files: ' + filenames;
        });
    });
</script>





<!-- Get subCategories with ajax -->
<script>


    $(document).ready(function () {
        const categorySelect = $('#product-category');
        const subcategoryContainer = $('#product-subcategory');


        categorySelect.change(function () {
            // درخواست Ajax برای دریافت زیر دسته‌ها
            const selectedCategoryIds = $(this).val();

            $.ajax({
                url: '{{ route('get-subcategories') }}',
                type: 'GET',
                data: {
                    category_id: selectedCategoryIds
                },
                success: function (data) {
                    subcategoryContainer.empty();

                    $.each(data, function (index, subcategory) {
                        // ایجاد المان li برای زیر دسته
                        const subcategoryItem = $('<li>', {
                            class: 'list-group-item',
                        });

                        subcategoryItem.append(
                            $('<input>', {
                                class: 'form-check-input me-1',
                                type: 'checkbox',
                                value: subcategory.id,
                                name: 'categories[]',
                               // checked: selectedCategories.includes(subcategory.id) // چک کردن چک‌باکس اگر انتخاب شده بوده

                            })
                        );

                        subcategoryItem.append(subcategory.name);

                        // ایجاد المان ul برای زیر دسته‌های جدید
                        const subsubcategoryList = $('<ul>', {
                            class: 'list-group',
                        });

                        subcategoryItem.append(subsubcategoryList);

                        // افزودن المان زیر دسته به لیست
                        subcategoryContainer.append(subcategoryItem);

                        // اضافه کردن رویداد change به چک‌باکس‌های زیر دسته
                        subcategoryItem.find('input[type="checkbox"]').change(function () {
                            const selectedSubcategoryIds = subcategoryItem.find('input[type="checkbox"]:checked').map(function () {
                                return this.value;
                            }).get();

                            // درخواست Ajax برای زیر دسته‌های انتخاب شده
                            $.ajax({
                                url: '{{ route('get-subcategories') }}',
                                type: 'GET',
                                data: {
                                    category_id: selectedSubcategoryIds
                                },
                                success: function (subcategories) {
                                    // در اینجا می‌توانید زیر دسته‌های انتخاب شده را نمایش دهید

                                    // ایجاد المان checkbox برای زیر دسته‌های جدید
                                    subsubcategoryList.empty();

                                    $.each(subcategories, function (index, subcategory) {
                                        // ایجاد المان li برای زیر دسته جدید
                                        const subcategoryItem = $('<li>', {
                                            class: 'list-group-item mt-2 text-primary font-12',
                                        });

                                        subcategoryItem.append(
                                            $('<input>', {
                                                class: 'form-check-input me-1',
                                                type: 'checkbox',
                                                value: subcategory.id,
                                                name: 'categories[]',
                                               // checked: selectedCategories.includes(subcategory.id) // چک کردن چک‌باکس اگر انتخاب شده بوده
                                            })
                                        );

                                        subcategoryItem.append(subcategory.name);

                                        // افزودن المان زیر دسته به لیست
                                        subsubcategoryList.append(subcategoryItem);
                                    });
                                }
                            });
                        });
                    });

                    // رفرش زیر دسته‌ها زمانی که دسته والد آخری حذف می‌شود
                    categorySelect.on('chosen:removed', function () {
                        subcategoryContainer.empty();
                    });
                }
            });
        });
    });




</script>








<script>
    $(document).ready(function() {
        // Get references to form elements
        $('#submit').hide(10);
        const form = $('#myForm');
        const validatorButton = $('#validator');

        // Add click event listener to the custom validation button
        validatorButton.on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Serialize form data
            const formData = form.serialize();  // Use serialize() to get all form data

            // Get CSRF token from the meta tag in the head
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send AJAX request to validate data
            $.ajax({
                url: '{{ route('product-validator') }}',
                type: 'POST',
                dataType: 'json',
                data: formData,  // Pass the serialized form data
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response, status, xhr)
                {
                    $('#submit').show(100);
                },
                error: function(xhr, status, error) {

                    if (xhr.status === 400) {
                        // Forbidden (validation failed) response
                        const errors = xhr.responseJSON.errors;
                        $('#submit').hide(350);
                        showErrorsWithSweetAlert(errors);


                    }

                }
            });
        });


        function showErrorsWithSweetAlert(errors) {
            const errorMessages = Object.values(errors).join('\n');

            Swal.fire({
                icon: 'error',
                title: 'خطا در اعتبارسنجی',
                html: errorMessages.replace(/\n/g, '<li>'), // Replace newlines with <br> for HTML
                confirmButtonText: 'تایید',
                text: errorMessages,
            });
        }

    });


</script>







<script>
    $(document).ready(function() {
        // Get references to form elements
        $('#submit').hide(10);
        const form = $('#myForm');
        const validatorButton = $('#validatorEdit');

        // Add click event listener to the custom validation button
        validatorButton.on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Serialize form data
            const formData = form.serialize();  // Use serialize() to get all form data

            // Get CSRF token from the meta tag in the head
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send AJAX request to validate data
            $.ajax({
                url: '{{ route('product-validator') }}',
                type: 'PUT',
                dataType: 'json',
                data: formData,  // Pass the serialized form data
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response, status, xhr)
                {
                    $('#submit').show(250);
                },
                error: function(xhr, status, error) {

                    if (xhr.status === 400) {
                        // Forbidden (validation failed) response
                        const errors = xhr.responseJSON.errors;
                        $('#submit').hide(350);
                        showErrorsWithSweetAlert(errors);


                    }

                }
            });
        });


        function showErrorsWithSweetAlert(errors) {
            const errorMessages = Object.values(errors).join('\n');

            Swal.fire({
                icon: 'error',
                title: 'خطا در اعتبارسنجی',
                html: errorMessages.replace(/\n/g, '<li>'), // Replace newlines with <br> for HTML
                confirmButtonText: 'تایید',
                text: errorMessages,
            });
        }

    });


</script>


// Add Dynamic Options
<script>

    $(document).ready(function () {
        $('#addOptionsButton').click(function () {
            const newOptionDiv = $('<div class="option-row form-group"></div>');

            const optionNameInput = $('<input class="property p-1 m-2 w-75" type="text" name="optionName[]" placeholder=" نوع">');
            const optionPriceInput = $('<input min = "0" class="propertyvalue p-1 m-2 w-75" type="number" name="optionPrice[]" placeholder=" قیمت">');
            const removeButton = $('<button type="button" class="waves-effect waves-light m-2 p-1 btn btn-md btn-outline-pink remove-option btn-xs">حذف</button><hr class="border-warning w-50">');

            removeButton.click(function () {
                $(this).parent().remove();
            });

            newOptionDiv.append(optionNameInput);
            newOptionDiv.append(optionPriceInput);
            newOptionDiv.append(removeButton);

            $('#newoptions').append(newOptionDiv);
        });

        $(document).on('click', '.remove-option', function () {
            $(this).parent().remove();
        });

        $('#myForm').submit(function (event) {
            const optionNames = $('input[name^="optionName"]');
            const optionPrices = $('input[name^="optionPrice"]');

            // Create an array of objects for options
            const options = [];
            for (let i = 0; i < optionNames.length; i++) {
                options.push({
                    name: $(optionNames[i]).val(),
                    value: $(optionPrices[i]).val(),
                });
            }

            // Attach the options data as a JSON string to a hidden input field
            $('#optionsData').val(JSON.stringify(options));
        });
    });




</script>



<script> // Add Attribute Features
    $(document).ready(function () {
        $('#addAttributeButton').click(function () {
            const newAttributeDiv = $('<div class="attribute-row form-group"></div>');

            const attributeNameInput = $('<input  class="property p-1 m-2 w-75"  type="text" name="attributeName[]" placeholder="نام ویژگی">');
            const attributeValueInput = $('<input  class="propertyvalue p-1 m-2 w-75" type="text" name="attributeValue[]" placeholder="مقدار ویژگی">');
            const removeButton = $('<button  type="button" class="waves-effect waves-light m-2 p-1 btn btn-md btn-outline-pink remove-attribute btn-xs">حذف</button> <hr class="border-warning  w-50"> '
            );
            const attributeContainer = document.getElementById('attributeContainer');
            removeButton.click(function () {
                $(this).parent().remove();
            });

            newAttributeDiv.append(attributeNameInput);
            newAttributeDiv.append(attributeValueInput);
            newAttributeDiv.append(removeButton);

            $('#newfeatures').append(newAttributeDiv);
        });

        $(document).on('click', '.remove-attribute', function () {
            $(this).parent().remove();
        });

        removeButton.addEventListener('click', function () {
            attributeContainer.removeChild(newAttributeDiv);
        });

        $('#myForm').submit(function (event) {
            const attributeNames = $('input[name^="attributeName"]');
            const attributeValues = $('input[name^="attributeValue"]');

            // Create an array of objects for attributes
            const attributes = [];
            for (let i = 0; i < attributeNames.length; i++) {
                attributes.push({
                    name: $(attributeNames[i]).val(),
                    value: $(attributeValues[i]).val(),
                });
            }

            // Attach the attributes data as a JSON string to a hidden input field
            $('#attributesData').val(JSON.stringify(attributes));
        });
    });

</script>


<script>
    // Add data-help attribute to elements that need help


    // Event listener for F1 key press
    $(document).keydown(function(event) {
        if (event.shiftKey && (event.key === 'z' || event.key === 'Z' || event.which === 1594)) {

            alert('help'); // You can replace this with your own help display logic

        }
    });
</script>


<!-- Include SweetAlert2 library -->


<script>
    // Add an event listener to the reset button
    document.getElementById('resetButton').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default reset behavior

        // Display the SweetAlert2 confirmation dialog
        Swal.fire({
            title: 'اطمینان دارید؟',
            text: "همه ورودی ها به حالت اولیه برمیگردند!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'لغو',
            confirmButtonText: 'بله !'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, reset the form
                document.getElementById('myForm').reset();
                Swal.fire(
                    'انجام شد',
                    '',
                    'success'
                );
            }
        });
    });


</script>



<script>
    $(document).ready(function() {
        $('.btn-remove').on('click', function() {
            const imageId = $(this).data('image-id');

            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                input: 'checkbox',
                inputValue: 0,
                inputPlaceholder:
                    'حذف تصویر از حافظه',

                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'بله، حذف شود',
                cancelButtonText: 'لغو'
            }).then((result) => {
                if (result.isConfirmed) {
                    const url = '{{ route("liveRemove", ["id" => "__id__"]) }}';
                    const ajaxUrl = url.replace('__id__', imageId);
                    const isConfirmedValue = result.value ? 1 : 0;

                    $.ajax({
                        url: ajaxUrl,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            isConfirmed: isConfirmedValue
                        },
                        success: function(response) {
                            $('#' + imageId).closest('.col').hide(650);
                        },
                        error: function(error) {
                            console.error('Error deleting image', error);
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.custom-image-thumb').on('click', function() {
            const imageSrc = $(this).attr('src');

            $('#modalImage').attr('src', imageSrc); // Set the modal image source
            $('#imageModal').modal('show'); // Show the modal
        });
    });
</script>





<script>
    $(document).ready(function() {
        $('#product-name,#product-quantity #product-price, #product-quantity,#product-name,#editor1,#product-summary,#product-brand,#product-category,#product-discount,#product-unit,.property,.propertyvalue').on('keypress', function() {
            $('#submit').hide();
        });


    });
</script>






<script>
    // انتخاب عنصر div
    var divElement = document.querySelector('div[style="height: auto;overflow-y: scroll;scrollbar-face-color: #0a58ca"]');

    // تابعی برای بررسی و تنظیم ارتفاع div
    function adjustDivHeight() {
        var currentHeight = divElement.clientHeight;
        if (currentHeight > 350) {
            divElement.style.height = '350px';
        }
    }

    // اضافه کردن رویداد به div برای بررسی تغییرات در آن
    divElement.addEventListener('DOMSubtreeModified', adjustDivHeight);

    // تابع اولیه برای اجرا
    adjustDivHeight();




    var divElementi = $('#newfeatures');

    // تابعی برای بررسی و تنظیم ارتفاع div
    function adjustDivHeighti() {
        var currentHeight = divElementi.height();
        if (currentHeight > 350) {
            divElementi.css('height', '390px');
        }
    }

    // اضافه کردن رویداد به div برای بررسی تغییرات در محتوا
    divElementi.on('DOMNodeInserted', adjustDivHeighti);

    // تابع اولیه برای اجرا
    adjustDivHeighti();

    // تابع برای بررسی تغییرات در ویژگی‌های style با استفاده از MutationObserver
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === 'style') {
                adjustDivHeighti();
            }
        });
    });

    // شروع مشاهده تغییرات در ویژگی‌های style
    observer.observe(divElementi[0], { attributes: true });


</script>
