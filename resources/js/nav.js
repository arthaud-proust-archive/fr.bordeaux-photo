module.exports = {
    
    isVisible: elem => !!elem && !!( elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length ),
    getMenuTogglerSvgContent: function() {
        return `<path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${this.open?'M6 18L18 6M6 6l12 12':'M4 6h16M4 12h16M4 18h16'}" />`
        
    },
    toggle: function(element) {
        console.log(`${element.id}: ${this.open}`);
        element.classList.toggle('hidden', !this.open);
        element.classList.toggle('block', this.open);
    },
    init: function() {
        this.open=false ;
        this.dropdownTrigger= document.getElementById('trigger');
        this.dropdownBox= document.getElementById('dropdown');
        this.responsiveMenu= document.getElementById('responsiveMenu');
        this.menuTogglerBtn= document.getElementById('menuToggler');
        this.menuTogglerSvg= document.querySelector('#menuToggler svg');
        this.menuTogglerBtn.addEventListener('click', ()=>{
            this.open = !this.open;
            this.menuTogglerSvg.innerHTML = this.getMenuTogglerSvgContent();
            this.toggle(this.responsiveMenu);
        })

        this.hideOnClickOutside(this.dropdownTrigger, ()=>{
            this.open = false;
            this.toggle(this.dropdownBox);
        });
        this.dropdownTrigger.addEventListener('click', ()=>{
            this.open = !this.open;
            this.toggle(this.dropdownBox);
        })
    },
    hideOnClickOutside: function(element, callback) {
        const outsideClickListener = event => {
            if (!element.contains(event.target) && this.isVisible(element)) { // or use: event.target.closest(selector) === null
                callback();
                // element.style.display = 'none'
                // this.open = !this.open
                // this.toggle(element);
                //   removeClickListener()
            }
        }
    
        const removeClickListener = () => {
            document.removeEventListener('click', outsideClickListener)
        }
    
        document.addEventListener('click', outsideClickListener)
    }
}