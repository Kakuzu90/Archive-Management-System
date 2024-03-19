<div class="card card-border-shadow-{{ $color }} h-100">
    <div class="card-body">
        <div class="d-flex align-items-center mb-2 pb-1">
            <div class="avatar me-2">
              <span class="avatar-initial rounded bg-label-{{ $color }}"
                ><i class="mdi {{ $icon }} mdi-20px"></i
              ></span>
            </div>
            <h4 class="ms-1 mb-0 display-6">{{ $count }}</h4>
        </div>
        <p class="mb-0 text-heading">{{ $title }}</p>
    </div>
</div>