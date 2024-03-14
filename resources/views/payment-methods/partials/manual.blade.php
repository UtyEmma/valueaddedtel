<div>
    <div class="row g-5">
        <div class="col-md-1">
            <div>
                <i class="ki-outline ki-password-check fs-1"></i>
            </div>
        </div>
        <div class="col-md-11">
            <div>
                <p class="fw-semibold text-muted mb-0">Account Number</p>
                <p class="fw-bold fs-2 lh-1 mb-0" style="user-select: all;" >2078972731</p>
            </div>

            <div class="separator separator-dashed my-4"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1">
            <div>
                <i class="ki-outline ki-bank fs-1"></i>
            </div>
        </div>
        <div class="col-md-11">
            <div>
                <p class="fw-semibold text-muted mb-0">Bank</p>
                <p class="fw-bold fs-5 lh-1 mb-0">United Bank for Africa</p>
            </div>

            <div class="separator separator-dashed my-4"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1">
            <div>
                <i class="ki-outline ki-user fs-1"></i>
            </div>
        </div>
        <div class="col-md-11">
            <div>
                <p class="fw-semibold text-muted mb-0">Account Name</p>
                <p class="fw-bold fs-5 lh-1 mb-0">Xtravalue Added Telecom</p>
            </div>

        </div>
    </div>

    <div class="separator separator-dashed my-5"></div>

    <div x-data="{
        no: 2078972731,
        copy: `<i class='ki-outline ki-copy fs-1'></i> Copy Account Number`,
        copyNo(){
            window.navigator.clipboard.writeText(this.no);
            this.copy = `<i class='ki-outline ki-copy-success fs-1'></i> Account Number Copied!`;
            setTimeout(() => this.copy = `<i class='ki-outline ki-copy fs-1'></i> Copy Account Number`, 2000)
        }
    }">
        <x-button x-on:click="copyNo" class="btn-light-success w-100" x-html="copy"></x-button>
    </div>

    <div class="mt-5 border rounded p-3">
        <p class="text-muted mb-0 fs-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis molestiae ratione consequuntur ullam animi odio! Aspernatur, doloremque. Aperiam, doloribus consequatur.</p>
    </div>
</div>
