require('./bootstrap');
// require('alpinejs');
require('lazysizes');
const Theme = require('./theme');
const Quill = require('quill');
const navManager = require('./nav');

let Link = Quill.import('formats/link');
class MyLink extends Link {
    static create(value) {
        let node = super.create(value);
        value = this.sanitize(value);
        if ( (value.startsWith('https://') || value.startsWith('http://') ) && !value.startsWith('https://bordeaux-photo.fr')  && !value.startsWith('http://bordeaux-photo.fr')) {
            node.className = 'link--external'
        } else {
            node.removeAttribute('target')
        }
        return node;
    }
}
Quill.register(MyLink);
let Inline = Quill.import('blots/inline');
class Pagelink extends Inline{    
    static create(value){
        let node = super.create(value);
        // node.setAttribute('class','pagelink');
        node.setAttribute('href', 'page-'+value);
        return node;    
    } 
}
Pagelink.blotName = 'pagelink';
Pagelink.tagName = 'span';
Quill.register(Pagelink);
class Readmore extends Inline{    
    static create(value){
        let node = super.create();
        node.setAttribute('class','readmore');
        return node;
    } 
}
Readmore.blotName = 'readmore';
Readmore.tagName = 'div';
Quill.register(Readmore);

/*let themeColors = {
    dark: {
        '--w1': {r:250, g:250, b:250},
        '--w2': {r:226, g:226, b:226},
        '--w3': {r:187, g:187, b:187},

        '--b0': {r:12, g:12, b:15},
        '--b1': {r:22, g:22, b:26},
        '--b2': {r:39, g:39, b:39},
        '--b3': {r:27, g:27, b:27},
    
        '--p1': {r:91, g:25, b:153},
        '--p2': {r:109, g:28, b:185},
    
        '--r0': {r:184, g:31, b:31}
    },
    light: {
        '--w1': {r:12, g:12, b:15},
        '--w2': {r:39, g:39, b:39},
        '--w3': {r:97, g:97, b:97},

        '--b0': {r:255, g:255, b:255},
        '--b1': {r:245, g:245, b:245},
        '--b2': {r:236, g:236, b:236},
        '--b3': {r:187, g:187, b:187},
    
        '--p1': {r:165, g:96, b:230},
        '--p2': {r:126, g:17, b:228},
    
        '--r0': {r:230, g:84, b:84}
    }
}*/

const themeColors = {
    dark:{
        '--p1': 'rgb(250,250,250)',
        '--p2': 'rgb(226,226,226)',
        '--p3': 'rgb(187,187,187)',
        '--si': 'rgb(53, 53, 53)',
        '--s0': 'rgb(12,12,15)',
        '--s1': 'rgb(22,22,26)',
        '--s2': 'rgb(39,39,39)',
        '--s3': 'rgb(53, 53, 53)',
        // '--t1': 'rgb(91,25,153)',
        // '--t2': 'rgb(109,28,185)',
        '--t0': 'rgb(184,31,31)',
        '--t1': 'rgb(78,118,205)',
        '--t2': 'rgb(62,98,178)',
        
        '--green0': 'rgb(50,143,109)',
        '--green1': 'rgb(202,240,222)',

        '--red0': 'rgb(143,76,76)',
        '--red1': 'rgb(254,202,202)',

        '--shade': 'rgb(12,12,12)',
    },
    light:{
        '--p1': 'rgb(12,12,15)',
        '--p2': 'rgb(39,39,39)',
        '--p3': 'rgb(97,97,97)',
        // '--si': 'rgb(245,245,245)',
        '--si': 'rgb(252,252,252)',
        '--s0': 'rgb(255,255,255)',
        '--s1': 'rgb(245,245,245)',
        '--s2': 'rgb(236,236,236)',
        '--s3': 'rgb(216, 216, 216)',
        // '--t1': 'rgb(165,96,230)',
        // '--t2': 'rgb(126,17,228)',
        '--t0': 'rgb(230,84,84)',

        '--t1': 'rgb(96,138,230)',
        '--t2': 'rgb(61,105,202)',

        '--green0': 'rgb(186,230,206)',
        '--green1': 'rgb(45,125,96)',

        '--red0': 'rgb(243,156,156)',
        '--red1': 'rgb(149,74,74)',

        '--shade': 'rgb(255,255,255)',
    },
}




const initPage = function() {
    document.querySelectorAll('.actionLoading').forEach(loading=>{
        console.log(loading);
        loading.classList.remove('actionLoading');
    });
    navManager.init();
    console.log('Page changed, init fired');
    document.getElementById('themeToggler').addEventListener('click', function() {
        if(appTheme.actual == 'dark') {
            appTheme.set('light', 500)
        } else {
            appTheme.set('dark', 500)
        }
    })

    appTheme.updateToggler();

    document.querySelectorAll('.url-input').forEach(input=> {
        input.addEventListener('keyup', function() {
            this.value = removeDiacritics(this.value);
        })
    });

    document.querySelectorAll('a, button[type="submit"]').forEach(link=>{
        // document.querySelectorAll('main a, header a, footer a, button[type="submit"]').forEach(link=>{
        link.addEventListener('click', function(e) {
            this.classList.add('actionLoading');
        });
    });
    // document.querySelectorAll('a').forEach(link=>{
    //     if(!link.getAttribute("href")) return

        // if(link.getAttribute("href").charAt(0) =='#') {
        //     link.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         document.querySelector(this.getAttribute("href")).scrollIntoView({
        //             behavior: "smooth"
        //         });
        //     });
        // } else {
        //     link.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         document.body.classList.remove('loaded');
        //         // document.getElementById('maskLeave').classList.add('active');
        //         setTimeout(function() {
        //             console.log(link);
        //             document.location = link.href;
        //         }, 250);
        //     });
        // }
    // })    

    window.forms = [];
    document.querySelectorAll('.deltaForm').forEach(form=>{
        const quillContainer = form.querySelector('.quillContainer');
        const quillHidden = form.querySelector('.quillHidden');
        const submitBtn = form.querySelector('input[type="submit"], button[type="submit"]');

        if(quillContainer && quillHidden && submitBtn) {
            let editor = new Quill(quillContainer, {
                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        [{color: [...appTheme.colorCSSVars, false]}, {background: [...appTheme.colorCSSVars, false]}],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['blockquote', 'code-block', 'link'],
                        ['pagelink'],
                        ['clean'],
                    ]
                },
                placeholder: quillContainer.dataset.placeholder||'',
                theme: 'snow'  // or 'bubble'
            });

            editor.getModule('toolbar').addHandler('pagelink', function(value) {
                var range = editor.getSelection();
                if(range && range.length>0){
                    console.log(range);
                    var popup = form.querySelector('.quillPopup');
                    console.log('range is valid');
                    popup.classList.add('show');
                    form.querySelector('.quillPopup-cancel').addEventListener('click', function(e) {
                        e.preventDefault();
                        popup.classList.remove('show');
                    });
                    form.querySelector('.quillPopup-save').addEventListener('click', function(e) {
                        e.preventDefault();
                        popup.classList.remove('show');
                        let link =popup.querySelector('[name="page_selection"]').value;
                        editor.formatText(range,{link});
                    });
                }else{
                    console.log('it is invalid');
                }
            });
            // document.querySelector('.ql-pagelink').addEventListener('click', function(e) {
            //     e.preventDefault()  
            //     console.log('function called');
            //     var range = editor.getSelection();
            //     if(range){
            //         console.log('range is valid');
            //         editor.formatText(range,{'pagelink':"e"});
            //     }else{
            //         console.log('it it invalid');
            //     }
            // });

            try {
                editor.setContents(JSON.parse(quillHidden.value));
            } catch(e) {}

            submitBtn.addEventListener('click', function(e) {
                quillHidden.value = JSON.stringify(editor.getContents());
            })

            window.forms.push(editor);
        }
    });

    window.quills = [];
    document.querySelectorAll('.quillContent').forEach(contentDiv=>{
        let content = contentDiv.innerHTML.trim();
        try {
            const params = {
                modules: {
                    toolbar: false
                },
                readOnly: true,
                theme: 'snow'  // or 'bubble'
            };
            const maxLength = 300;
            const showBtnClasses = 'm-2 px-3 py-1 bg-s3 rounded-md';

            let quill = new Quill(contentDiv, params);

            quill.setContents(JSON.parse(content));
            if(quill.getLength() > maxLength) {

                let introDiv = document.createElement('div');
                introDiv.setAttribute('class', contentDiv.getAttribute('class').replace('quillContent','quillIntro'));
                introDiv.innerText = quill.root.innerText.replace(/\n{2,}/gm, '\n').slice(0, maxLength) +'...';
                contentDiv.before(introDiv)
                
                contentDiv.classList.add('hidden')

                let showMore = document.createElement('button');
                showMore.innerText="En voir plus"
                showMore.setAttribute('class', showBtnClasses);
                showMore.addEventListener('click', function() {
                    introDiv.classList.add('hidden');
                    showMore.classList.add('hidden');
                    contentDiv.classList.remove('hidden');
                    showLess.classList.remove('hidden');
                });
                // contentDiv.before(showMore)
                introDiv.append(showMore)

                let showLess = document.createElement('button');
                showLess.innerText="En voir moins"
                showLess.setAttribute('class', showBtnClasses + ' hidden');
                showLess.addEventListener('click', function() {
                    introDiv.classList.remove('hidden');
                    showMore.classList.remove('hidden');
                    contentDiv.classList.add('hidden');
                    showLess.classList.add('hidden');
                });
                contentDiv.after(showLess)

                // console.log(quill.root.innerText.replace(/\n\n/gm, ''));
            }
        } catch(e) {console.warn(e)}
    });

    document.querySelectorAll('.quillContentAsync').forEach(div=>{
        let card = div.closest(".async-card").dataset;
        axios.get(`/api/${card.type}/${card.hashid}/desc`).then(r=>{
            try {
                let quill = new Quill(div, {
                    modules: {
                        toolbar: false
                    },
                    readOnly: true,
                    theme: 'snow'  // or 'bubble'
                });
                quill.setContents(r.data);
            } catch(e) {console.warn(e)}
        })
    });

    document.querySelectorAll('.readmore').forEach(readmore=> {
        readmore.addEventListener('click', function() {
            axios.get(`/api/event/${this.closest(".event-card").dataset.hashid}/desc`).then(r=>{
                try {
                    let quill = new Quill(this.closest(".quillContent"), {
                        modules: {
                            toolbar: false
                        },
                        readOnly: true,
                        theme: 'snow'  // or 'bubble'
                    });
                    quill.setContents(r.data);
                } catch(e) {console.warn(e)}
            })
        })
    });
    // window.disableLitepickerStyles = true;
    document.querySelectorAll('input[data-type="date"]').forEach(input=>{
        let picker = new Litepicker({
            autoRefresh: true,
            singleMode: false,
            minDays: 0,
            format: 'DD-MM-YYYY',
            delimiter: '  à  ',
            element: input
        });
    });


    // dragover and dragenter events need to have 'preventDefault' called
    // in order for the 'drop' event to register. 
    // See: https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/Drag_operations#droptargets
    const dropContainers = document.querySelectorAll('.dropContainer');
    const loadFile = function (file, container) {

        if (!FileReader || !file) {
            return;
        }
    
        var reader = new FileReader();
        reader.onload = function (e) {
            container.style.backgroundImage = `url(${e.target.result})`;

            container.classList.remove('dropStarted');
            container.classList.add('dropDone');
            // resizedataURL(e.target.result).then(img=>{
            //     new Compressor(img, {
            //         quality: 0.4,
            //         success(result) {
            //             result.name="image.jpg";
            //             document.getElementById("preview").src = URL.createObjectURL(result);
            //             const formData = new FormData();

            //             // The third parameter is required for server
            //             formData.append('img', result, result.name);

            //             // Send the compressed image file to server with XMLHttpRequest.
            //             axios.post('/profil/img', formData).then(r => {
            //                 console.log(r.data);
            //             });
            //         },
            //         error(err) {
            //             console.log(err.message);
            //         },
            //     });
            // })
        };
        reader.readAsDataURL(file);

        return;
        // new Compressor(files[0], {
        //     quality: 0.4,
        //     success(result) {
        //         result.name="image.jpg";
        //         document.getElementById("preview").src = URL.createObjectURL(result);
        //         const formData = new FormData();

        //         // The third parameter is required for server
        //         formData.append('img', result, result.name);

        //         // Send the compressed image file to server with XMLHttpRequest.
        //         axios.post('/profil/img', formData).then(r => {
        //             console.log(r.data);
        //         });
        //     },
        //     error(err) {
        //         console.log(err.message);
        //     },
        // });
    }
    dropContainers.forEach(dropContainer=>{
        let fileInput = dropContainer.querySelector('input[type="file"]');

        dropContainer.ondragover = dropContainer.ondragenter = function(e) {
            dropContainer.classList.add('dragOver');
            e.preventDefault();
        };
        

        dropContainer.ondragleave = function(e) {
            dropContainer.classList.remove('dragOver');
            e.preventDefault();
        };
        
        dropContainer.ondrop = function(e) {
            dropContainer.classList.remove('dragOver');
            dropContainer.classList.add('dropStarted');
            // pretty simple -- but not for IE :(
            fileInput.files = e.dataTransfer.files;
        
            loadFile(e.dataTransfer.files[0], dropContainer);

            /*
            // If you want to use some of the dropped files
            const dT = new DataTransfer();
            dT.items.add(e.dataTransfer.files[0]);
            // dT.items.add(e.dataTransfer.files[3]);
            fileInput.files = dT.files;
            */
            e.preventDefault();
        };

        fileInput.onchange = function (evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;

            
            loadFile(files[0], dropContainer);
        }
    })


    const elsDisabled = document.querySelectorAll('[disabled] .ql-editor, [disabled] .dropContainer, [disabled] button, [disabled] a, [disabled] label, [disabled] input, [disabled] textarea, [disabled] select');
    elsDisabled.forEach(input=>{
        input.contentEditable = false;
        input.onclick = input.onselect = input.ondragenter = input.ondrop = input.onmousedown = input.onmouseover = input.onfocus = input.onkeydown = function(e) {
            e.stopPropagation();
            e.stopImmediatePropagation();
            e.preventDefault();
            return false;
        }
        input.style.cursor = 'default';
    })
    const toolbarDisabled = document.querySelectorAll('[disabled] .ql-toolbar');
    toolbarDisabled.forEach(toolbar=>toolbar.style.display = "none");

    document.querySelectorAll('.close-alert').forEach(alert=> {
        setTimeout(()=> {
            alert.closest('.alert').classList.add('fade-out')
            setTimeout(()=> {
                alert.closest('.alert').style.display = "none";
            }, 500);
        }, 4000);
        alert.addEventListener('click', function(e) {
            this.closest('.alert').classList.add('fade-out')
            setTimeout(()=> {
                this.closest('.alert').style.display = "none";
            }, 500);
        })
    });

};
const initTheme = function() {
    window.appTheme = new Theme(themeColors, {
        transitionDuration: 200
    });
    appTheme.load();
}

const firstInit = function() {
    initTheme()
    initPage();
}
document.addEventListener('DOMContentLoaded', firstInit);
document.documentElement.addEventListener('turbo:render', initPage);

