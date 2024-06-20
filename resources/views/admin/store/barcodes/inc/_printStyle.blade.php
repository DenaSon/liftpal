<style>
    /* Define styles for printing */
    @media print {
        /* Hide the card header and form elements */
        .card-header, .form-group, .btn {
            display: none !important;
        }

        .barcode-form
        {
            display: none;

        }
        /* Center the QR code image when printing */
        .img-barcode {
            margin: 100px auto;
        }
        /* Hide the print button when printing */
        .print-button {
            display: none;
        }
    }
</style>
