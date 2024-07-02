<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs mt-3" role="tablist">
        <li class="nav-item">
            <a href="#request-form" class="nav-link active" data-bs-toggle="tab" role="tab">
                <i class="fi-send me-2"></i>
                ارسال درخواست
            </a>
        </li>

        <li class="nav-item">
            <a href="#responses" class="nav-link" data-bs-toggle="tab" role="tab">
                <i class="fi fi-help me-2"></i>
                مشاهده پاسخ
            </a>
        </li>

    </ul>

    <!-- Tabs content -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="request-form" role="tabpanel">
            @include('livewire.front.panel.components.support-inc.request-form')

        </div>
        <div class="tab-pane fade" id="responses" role="tabpanel">
            @include('livewire.front.panel.components.support-inc.responses')
        </div>


    </div>


</div>
