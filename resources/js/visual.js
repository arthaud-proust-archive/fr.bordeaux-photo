const { isMatchWith, size } = require("lodash");

const visuals = document.querySelectorAll('.visual');

const SIZE = 4096;
const IMG_SIZE = SIZE*0.80;
const LAUREAT_SIZE = SIZE*0.3;

visuals.forEach(visual=>{
    let canvas = document.createElement('canvas');
    canvas.height = canvas.width = SIZE;
    let ctx = canvas.getContext("2d");

    // ctx.fillStyle = "#232323";
    ctx.fillStyle = "#0d0d0e";
    ctx.fillRect(0,0,SIZE,SIZE);

    setImage(visual, ctx, function() {
        ctx.fillStyle = "#ffffff"
        ctx.font = '180px sans-serif'

        let authorTxt = `Par ${visual.dataset.author}`;
        let eventTxt = `Thème ${visual.dataset.event}`;
        let laureatsTxt = JSON.parse(visual.dataset.laureats).join(' - ');
        let authorCoords = ctx.measureText(authorTxt);
        let eventCoords = ctx.measureText(eventTxt);
        let laureatsCoords = ctx.measureText(laureatsTxt);

        ctx.fillRect(0, 150, SIZE, 10)

        ctx.rotate(-Math.PI/2);

        ctx.fillRect(-SIZE, 150, 300, 10)
        ctx.fillText(authorTxt, -SIZE+400, 200)
        ctx.fillRect(-SIZE+500+authorCoords.width, 150, SIZE-(100+authorCoords.width), 10)
        
        ctx.rotate(Math.PI);

        ctx.fillRect(0, -SIZE+150, 300, 10)
        ctx.fillText(eventTxt, 400, -SIZE+220)
        ctx.fillRect(500+eventCoords.width, -SIZE+150, SIZE-(100+eventCoords.width), 10)
        
        ctx.rotate(-Math.PI/2);

        ctx.fillRect(0, SIZE-150, 300, 10)
        ctx.fillText(laureatsTxt, 400, SIZE-100)
        ctx.fillRect(500+laureatsCoords.width, SIZE-150, SIZE-(100+laureatsCoords.width), 10)
        

        // setLaureats(visual, ctx);
    });
    visual.appendChild(canvas);
    canvas.addEventListener('click', function() {
        exportCanvasAsJPG(this, 'text')
    })
})


function setImage(visual, ctx, callback) {
    var img = new Image(); 
    var ratio, spaceX,spaceY,w,h;
    img.addEventListener('load', function() {

        if(img.width==img.height) {
            ratio = 1
            w = h = IMG_SIZE
        } else if(img.width<img.height) {
            ratio = img.width/img.height
            h = IMG_SIZE
            w = IMG_SIZE*ratio
        } else {
            ratio = img.height/img.width
            h = IMG_SIZE*ratio
            w = IMG_SIZE
        }

        spaceX = (SIZE-w)/2
        spaceY = (SIZE-h)/2

        ctx.drawImage(img, 
            spaceX,
            spaceY,
            w, 
            h
        );

        callback()

    }, false);
    img.src = visual.dataset.image;
}

function setLaureats(visual, ctx) {
    const laureats = JSON.parse(visual.dataset.laureats);
    for(let i=0; i<laureats.length;i++) {
        var img = new Image(); 
        img.addEventListener('load', function() {
            ratio = img.height/img.width
            ctx.drawImage(img, 
                (SIZE-LAUREAT_SIZE)/2,
                SIZE-LAUREAT_SIZE,
                LAUREAT_SIZE, 
                LAUREAT_SIZE*ratio
            );


        }, false);
        img.src = laureats[i];
    }
}

function exportCanvasAsJPG(canvasElement, fileName) {

    // var canvasElement = document.getElementById(id);

    var MIME_TYPE = "image/jpeg";

    var imgURL = canvasElement.toDataURL(MIME_TYPE);

    var dlLink = document.createElement('a');
    dlLink.download = fileName+'.jpg';
    dlLink.href = imgURL;
    dlLink.dataset.downloadurl = [MIME_TYPE, dlLink.download, dlLink.href].join(':');

    document.body.appendChild(dlLink);
    dlLink.click();
    document.body.removeChild(dlLink);
}