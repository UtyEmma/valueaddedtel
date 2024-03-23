
@assets
    <script src="https://js.paystack.co/v1/inline.js"></script>
@endassets

@script
    <script>
        Alpine.store('payment', {
            init(){
                $wire.on('payment:paystack', (data) => {
                    let handler = PaystackPop.setup({
                        ...data[0],
                        onClose: function(){
                            $wire.dispatch('payment:cancelled', {
                                method: 'paystack'
                            });
                        },

                        callback: function(response){
                            $wire.dispatch('payment:completed', {
                                response: response,
                                method: 'paystack'
                            });
                        }
                    });

                    handler.openIframe();
                })
            }
        })
    </script>
@endscript
