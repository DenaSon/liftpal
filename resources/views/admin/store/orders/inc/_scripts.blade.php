<script>
    $(document).ready(function() {
        // Select the delete buttons by their class
        $('.deleteButton').on('click', function() {
            // Get the user's ID from the data attribute
            var orderId = $(this).data('order-id');

            // Show the SweetAlert confirmation dialog
            Swal.fire({
                title: 'سفارش حذف شود؟',
                text: 'سفارش و تمام اطلاعات مرتبط به آن حذف خواهد شد.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'بله حذف',
                cancelButtonText: 'لغو'
            }).then((result) => {
                if (result.isConfirmed) {
                    // User clicked "Yes, delete it!" so you can submit the form here
                    // Form ID is "userDeleteForm-{{$user->id ?? 0}}"
                    $('#userDeleteForm-' + orderId).submit();
                }
            });
        });
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById('custom-modal');
        modal.style.display = 'none';
        var newButton = document.createElement('button');
        newButton.type = 'button';
        newButton.className = 'btn btn-sm btn-outline-primary';
        newButton.textContent = 'ایجاد سفارش جدید ';
        newButton.setAttribute('data-bs-toggle', 'modal');
        newButton.setAttribute('data-bs-target', '#custom-modal');

        var btnToolbar = document.querySelector('.btn-toolbar');
        btnToolbar.appendChild(newButton);
        var buttons = document.querySelectorAll('.btn-default');

// Loop through each button
        buttons.forEach(function(button) {
            // Check if the button has the class "dropdown-toggle"
            if (!button.classList.contains('dropdown-toggle')) {
                // Add the new class to buttons that don't have "dropdown-toggle"
                button.classList.add('hide-element'); // Replace 'new-class' with the class you want to add
            }
            else
            {
                button.classList.add('dropdown-element'); // Replace 'new-class' with the class you want to add
            }
        });



        // Get a reference to the button element by its ID
        var mybutton = document.querySelector('.dropdown-element');

        // Change the text of the button
        mybutton.textContent = 'نمایش';


    });

</script>













