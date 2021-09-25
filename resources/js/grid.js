window.addEventListener('resize', function() {
    handleGrid();
})

document.addEventListener("DOMContentLoaded", function() {
    handleGrid();
});

module.exports = function handleGrid() {
    // return
    document.querySelectorAll('.grid-adaptive').forEach(cardDiv=>{
        const cards = cardDiv.querySelectorAll('.grid-card');
        console.log(cards);
        var done = [];
        for(let i = 0; i<cards.length; i++) {
            let card = cards[i];

            card.style.marginTop = '0px';

            let lastColumnCard = undefined;

            for(let j=0; j<done.length; j++) {
                let dCoords = done[j].getBoundingClientRect();
                let cCoords = card.getBoundingClientRect();

                if(dCoords.x == cCoords.x) {
                    lastColumnCard = done[j];
                }
            }

            if(lastColumnCard) {
                let lCoords = lastColumnCard.getBoundingClientRect();
                let cCoords = card.getBoundingClientRect();
                let gap = getComputedStyle(card.parentElement).gap;
                card.style.marginTop = `calc(${lCoords.y+lCoords.height-cCoords.y }px + ${gap})`;
            }

            done.push(card);
        }
    })

    console.log('grid rendered');
}