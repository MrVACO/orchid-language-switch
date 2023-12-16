@if(!empty(config('orchid-language-switch.languages')))
    <div
        id="localization"
        class="col-xs-12 d-flex justify-content-end align-items-center"
    >
        <x-orchid-icon
            class="w-1x"
            path="bs.globe"
        />

        <select
            id="localization-switch"
        >
            @foreach(config('orchid-language-switch.languages') as $code => $lang)
                <option
                    @if(app()->getLocale() === $code)
                        selected
                    @endif
                    value="{{ $code }}"
                >
                    {{ $lang }}
                </option>
            @endforeach
        </select>
    </div>

    @push('stylesheets')
        <style lang="scss">
            #localization {
                select {
                    padding: 0 5px;
                    background: var(--bs-link-color);
                    color: var(--bs-nav-link-color);
                    border: 1px solid var(--bs-link-color);
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script type="text/javascript">
            document.addEventListener("turbo:load", () => {
                const selectElement = document.getElementById("localization-switch");

                selectElement.addEventListener("change", (event) => {
                    window.location.href = `{{ Dashboard::prefix('/orchid-language-switch') }}/${ event.target.value }`;
                });
            });
        </script>
    @endpush
@endif
