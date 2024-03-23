<div {{$attributes}} x-data="{
    text: @js($text),
    label: 'Copy',
    copy(){
        console.log('Copy');
        window.navigator.clipboard.writeText(this.text)
        this.label = 'Copied';
        setTimeout(() => this.label = 'Copy', 2000)
    }
}">
    {{$slot}}
</div>
