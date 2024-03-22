
@assets
    <script src="https://js.paystack.co/v1/inline.js"></script>
@endassets

@script
    <script>
        Alpine.store('payment', {
            init(){
                $wire.on('pay:paystack', (data) => {
                    let handler = PaystackPop.setup({
                        ...data[0],
                        onClose: function(){
                            $wire.dispatch('payment:cancelled');
                        },

                        callback: function(response){
                            $wire.dispatch('payment:completed', response);
                        }
                    });

                    handler.openIframe();
                })
            }
        })
    </script>
@endscript
