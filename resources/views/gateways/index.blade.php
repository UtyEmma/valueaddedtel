@include('gateways.paystack')


<script>
    const block = () => {
        Notiflix.Loading.standard('Processing Payment...', {
            clickToClose: false,
            svgColor: '#00007A',
            backgroundColor: 'rgba(255,255,255,0.8)',
            messageColor: '#00007A'
        })
    }
</script>
