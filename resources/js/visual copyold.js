const laureats = document.querySelectorAll('.visual.laureat');
const events = document.querySelectorAll('.visual.event');

const SIZE = 4096;
const IMG_SIZE = SIZE*0.80;
const LAUREAT_SIZE = SIZE*0.3;

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1)
}

laureats.forEach(visual=>{
    let canvas = visual.querySelector('canvas');
    canvas.height = canvas.width = SIZE;
    let ctx = canvas.getContext("2d");

    // ctx.fillStyle = "#232323";
    ctx.fillStyle = "#0d0d0e";
    ctx.fillRect(0,0,SIZE,SIZE);

    var authorTxt, authorCoords, eventTxt, eventCoords, laureatsTxt, laureatsCoords;
    setImage(visual, ctx, function() {
        ctx.fillStyle = "#ffffff"
        ctx.font = '110px sans-serif'

        let copyrightTxt = '@photo_a_bordeaux';
        let copyrightCoords = ctx.measureText('@photo_a_bordeaux');

        // ctx.fillRect(0, 150, 300, 10)
        // ctx.fillText(copyrightTxt, 350, 190)
        // ctx.fillRect(400+copyrightCoords.width, 150, SIZE-(400+copyrightCoords.width), 10)
        ctx.fillRect(0, 150, SIZE-(400+copyrightCoords.width), 10)
        ctx.fillText(copyrightTxt, SIZE-(350+copyrightCoords.width), 190)
        ctx.fillRect(SIZE-300, 150, 300, 10)


        ctx.font = '180px sans-serif'
        authorTxt = `Par ${visual.dataset.author}`;
        authorCoords = ctx.measureText(authorTxt);
        eventTxt = `Thème ${visual.dataset.event}`;
        laureatsTxt = JSON.parse(visual.dataset.laureats).join(' - ');
        eventCoords = ctx.measureText(eventTxt);
        laureatsCoords = ctx.measureText(laureatsTxt);

    
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
    canvas.addEventListener('click', function() {
        exportCanvasAsJPG(this, `${visual.dataset.event} - ${laureatsTxt}`)
    })
    canvas.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        exportCanvasAsJPG(this, `${visual.dataset.event} - ${laureatsTxt}`)
    })
    canvas.parentElement.addEventListener('mouseenter', function() {
        this.classList.remove('downloaded');
    })
})


events.forEach(visual=>{
    let canvas = visual.querySelector('canvas');
    canvas.height = canvas.width = SIZE;
    let ctx = canvas.getContext("2d");

    ctx.fillStyle = "#ffffff"
    // ctx.fillStyle = "#232323";
    ctx.fillRect(0,0,SIZE,SIZE);

    var authorTxt, authorCoords, eventTxt, eventCoords, laureatsTxt, laureatsCoords;

    ctx.fillStyle = "#0d0d0e";

    ctx.font = '110px sans-serif'

    let copyrightTxt = '@photo_a_bordeaux';
    let copyrightCoords = ctx.measureText('@photo_a_bordeaux');

    // ctx.fillRect(0, 150, 300, 10)
    // ctx.fillText(copyrightTxt, 350, 190)
    // ctx.fillRect(400+copyrightCoords.width, 150, SIZE-(400+copyrightCoords.width), 10)
    ctx.fillRect(0, 150, SIZE-(400+copyrightCoords.width), 10)
    ctx.fillText(copyrightTxt, SIZE-(350+copyrightCoords.width), 190)
    ctx.fillRect(SIZE-300, 150, 300, 10)


    ctx.font = '180px sans-serif'
    // pubTxt = `Évènement à Bordeaux`;
    pubTxt = ``;
    pubCoords = ctx.measureText(pubTxt);
    siteTxt = `Participez sur bordeaux-photo.fr`;
    shareTxt = 'Partage et commente !';
    siteCoords = ctx.measureText(siteTxt);
    shareCoords = ctx.measureText(shareTxt);


    ctx.rotate(-Math.PI/2);

    ctx.fillRect(-SIZE, 150, 300, 10)
    ctx.fillText(pubTxt, -SIZE+400, 200)
    ctx.fillRect(-SIZE+500+pubCoords.width, 150, SIZE-(100+pubCoords.width), 10)
    
    ctx.rotate(Math.PI);

    ctx.fillRect(0, -SIZE+150, 300, 10)
    ctx.fillText(siteTxt, 400, -SIZE+220)
    ctx.fillRect(500+siteCoords.width, -SIZE+150, SIZE-(100+siteCoords.width), 10)
    
    ctx.rotate(-Math.PI/2);

    ctx.fillRect(0, SIZE-150, 300, 10)
    ctx.fillText(shareTxt, 400, SIZE-100)
    ctx.fillRect(500+shareCoords.width, SIZE-150, SIZE-(100+shareCoords.width), 10)
        
    var typeTxt = visual.dataset.type.capitalize();
    var typeCoords = ctx.measureText(typeTxt);
    ctx.fillText(typeTxt, 500, 1000)
    setTypeicon(visual, ctx, typeCoords)
    ctx.fillText(visual.dataset.dates, 500, 1250)
    // ctx.fillText('Rendez-vous sur bordeaux-photo.fr', 500, 1500)
    // ctx.fillText('pour participer', 500, 1700)

    ctx.fillText('Thème', 500, 2000)

    var themeTxt = [visual.dataset.theme];
    var fontSize = 400
    var textPrinted = false
    ctx.textBaseline = 'top'
    while(!textPrinted) {
        ctx.font = `${fontSize}px sans-serif`
        for(let line=0; line<themeTxt.length;line++) {
            w = ctx.measureText(themeTxt[line]).width;
            if(w+500 > SIZE-500) {
                wLetter = w/themeTxt[line].length; // largeur par lettre
                // on cherche le dernier espace avant la limite à droite
                lMax = Math.floor((SIZE-(500+500))/wLetter);
                var iSpace=lMax;
                while(themeTxt[line].charAt(iSpace) !== " " && iSpace>0) {
                    iSpace--;
                }
                if(iSpace==0) {
                    fontSize -= 20;
                    break
                }
                n = themeTxt.indexOf(themeTxt[line]);
                themeTxt = [...themeTxt.slice(0, n), themeTxt[line].slice(0, iSpace), themeTxt[line].slice(iSpace+1), ...themeTxt.slice(n+1) ]
                console.log(themeTxt);
                console.log(themeTxt.length);
                break
            } else {
                console.log(line);
                ctx.fillText(themeTxt[line], 500, 2100+line*400)
                textPrinted=true;
            }
        }
    }
    
        // setLaureats(visual, ctx);
    canvas.addEventListener('click', function() {
        exportCanvasAsJPG(this, visual.dataset.theme)
    })
    canvas.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        exportCanvasAsJPG(this, visual.dataset.theme)
    })
    canvas.parentElement.addEventListener('mouseenter', function() {
        this.classList.remove('downloaded');
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

function setTypeicon(visual, ctx, typeCoords) {
    var img = new Image(); 
    img.addEventListener('load', function() {
        ctx.drawImage(img, 
            500+typeCoords.width+50,
            840,
            200, 
            200
        );


    }, false);
    img.src = visual.dataset.typeicon;
}

function exportCanvasAsJPG(canvasElement, fileName) {

    canvasElement.parentElement.classList.add('downloaded');
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
