require('./bootstrap');
require('alpinejs');
require('lazysizes');
const Theme = require('./theme');
const Quill = require('quill');
const { default: axios } = require('axios');



let Inline = Quill.import('blots/inline');


class Pagelink extends Inline{    
    
    static create(value){
        console.log(value);
        let node = super.create();
        node.setAttribute('class','pagelink');
        node.setAttribute('href', 'page-'+value);
        return node;    
    } 

    format(name, value) {
        if (name === 'pagelink' && value) {
            this.domNode.setAttribute('href', value);
        } else {
            super.format(name, value);
        }
    }
    
}

Pagelink.blotName = 'pagelink';
Pagelink.tagName = 'a';
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

window.removeDiacritics = function (str) {
    str = str.toLowerCase();
    var defaultDiacriticsRemovalMap = [
        {'base':'a', 'letters':/[\u0061\u24D0\uFF41\u1E9A\u00E0\u00E1\u00E2\u1EA7\u1EA5\u1EAB\u1EA9\u00E3\u0101\u0103\u1EB1\u1EAF\u1EB5\u1EB3\u0227\u01E1\u00E4\u01DF\u1EA3\u00E5\u01FB\u01CE\u0201\u0203\u1EA1\u1EAD\u1EB7\u1E01\u0105\u2C65\u0250]/g},
        {'base':'b', 'letters':/[\u0062\u24D1\uFF42\u1E03\u1E05\u1E07\u0180\u0183\u0253]/g},
        {'base':'c', 'letters':/[\u0063\u24D2\uFF43\u0107\u0109\u010B\u010D\u00E7\u1E09\u0188\u023C\uA73F\u2184]/g},
        {'base':'d', 'letters':/[\u0064\u24D3\uFF44\u1E0B\u010F\u1E0D\u1E11\u1E13\u1E0F\u0111\u018C\u0256\u0257\uA77A]/g},
        {'base':'e', 'letters':/[\u0065\u24D4\uFF45\u00E8\u00E9\u00EA\u1EC1\u1EBF\u1EC5\u1EC3\u1EBD\u0113\u1E15\u1E17\u0115\u0117\u00EB\u1EBB\u011B\u0205\u0207\u1EB9\u1EC7\u0229\u1E1D\u0119\u1E19\u1E1B\u0247\u025B\u01DD]/g},
        {'base':'f', 'letters':/[\u0066\u24D5\uFF46\u1E1F\u0192\uA77C]/g},
        {'base':'g', 'letters':/[\u0067\u24D6\uFF47\u01F5\u011D\u1E21\u011F\u0121\u01E7\u0123\u01E5\u0260\uA7A1\u1D79\uA77F]/g},
        {'base':'h', 'letters':/[\u0068\u24D7\uFF48\u0125\u1E23\u1E27\u021F\u1E25\u1E29\u1E2B\u1E96\u0127\u2C68\u2C76\u0265]/g},
        {'base':'i', 'letters':/[\u0069\u24D8\uFF49\u00EC\u00ED\u00EE\u0129\u012B\u012D\u00EF\u1E2F\u1EC9\u01D0\u0209\u020B\u1ECB\u012F\u1E2D\u0268\u0131]/g},
        {'base':'j', 'letters':/[\u006A\u24D9\uFF4A\u0135\u01F0\u0249]/g},
        {'base':'k', 'letters':/[\u006B\u24DA\uFF4B\u1E31\u01E9\u1E33\u0137\u1E35\u0199\u2C6A\uA741\uA743\uA745\uA7A3]/g},
        {'base':'l', 'letters':/[\u006C\u24DB\uFF4C\u0140\u013A\u013E\u1E37\u1E39\u013C\u1E3D\u1E3B\u017F\u0142\u019A\u026B\u2C61\uA749\uA781\uA747]/g},
        {'base':'m', 'letters':/[\u006D\u24DC\uFF4D\u1E3F\u1E41\u1E43\u0271\u026F]/g},
        {'base':'n', 'letters':/[\u006E\u24DD\uFF4E\u01F9\u0144\u00F1\u1E45\u0148\u1E47\u0146\u1E4B\u1E49\u019E\u0272\u0149\uA791\uA7A5]/g},
        {'base':'o', 'letters':/[\u006F\u24DE\uFF4F\u00F2\u00F3\u00F4\u1ED3\u1ED1\u1ED7\u1ED5\u00F5\u1E4D\u022D\u1E4F\u014D\u1E51\u1E53\u014F\u022F\u0231\u00F6\u022B\u1ECF\u0151\u01D2\u020D\u020F\u01A1\u1EDD\u1EDB\u1EE1\u1EDF\u1EE3\u1ECD\u1ED9\u01EB\u01ED\u00F8\u01FF\u0254\uA74B\uA74D\u0275]/g},
        {'base':'p','letters':/[\u0070\u24DF\uFF50\u1E55\u1E57\u01A5\u1D7D\uA751\uA753\uA755]/g},
        {'base':'q','letters':/[\u0071\u24E0\uFF51\u024B\uA757\uA759]/g},
        {'base':'r','letters':/[\u0072\u24E1\uFF52\u0155\u1E59\u0159\u0211\u0213\u1E5B\u1E5D\u0157\u1E5F\u024D\u027D\uA75B\uA7A7\uA783]/g},
        {'base':'s','letters':/[\u0073\u24E2\uFF53\u00DF\u015B\u1E65\u015D\u1E61\u0161\u1E67\u1E63\u1E69\u0219\u015F\u023F\uA7A9\uA785\u1E9B]/g},
        {'base':'t','letters':/[\u0074\u24E3\uFF54\u1E6B\u1E97\u0165\u1E6D\u021B\u0163\u1E71\u1E6F\u0167\u01AD\u0288\u2C66\uA787]/g},
        {'base':'u','letters':/[\u0075\u24E4\uFF55\u00F9\u00FA\u00FB\u0169\u1E79\u016B\u1E7B\u016D\u00FC\u01DC\u01D8\u01D6\u01DA\u1EE7\u016F\u0171\u01D4\u0215\u0217\u01B0\u1EEB\u1EE9\u1EEF\u1EED\u1EF1\u1EE5\u1E73\u0173\u1E77\u1E75\u0289]/g},
        {'base':'v','letters':/[\u0076\u24E5\uFF56\u1E7D\u1E7F\u028B\uA75F\u028C]/g},
        {'base':'w','letters':/[\u0077\u24E6\uFF57\u1E81\u1E83\u0175\u1E87\u1E85\u1E98\u1E89\u2C73]/g},
        {'base':'x','letters':/[\u0078\u24E7\uFF58\u1E8B\u1E8D]/g},
        {'base':'y','letters':/[\u0079\u24E8\uFF59\u1EF3\u00FD\u0177\u1EF9\u0233\u1E8F\u00FF\u1EF7\u1E99\u1EF5\u01B4\u024F\u1EFF]/g},
        {'base':'z','letters':/[\u007A\u24E9\uFF5A\u017A\u1E91\u017C\u017E\u1E93\u1E95\u01B6\u0225\u0240\u2C6C\uA763]/g},
        // {'base':'-','letters':/\s/g}
        {'base':'-','letters':/((?!\/)\W)+/g}
    ];
  
    for(var i=0; i<defaultDiacriticsRemovalMap.length; i++) { str = str.replace(defaultDiacriticsRemovalMap[i].letters, defaultDiacriticsRemovalMap[i].base) }
    return str;
}



window.nav = function(callback) {
    document.body.classList.remove('loaded');
    setTimeout(function() {
        callback();
    }, 250);
}
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
    },
}


document.addEventListener('DOMContentLoaded', function() {

    window.appTheme = new Theme(themeColors, {
        transitionDuration: 200
    });
    appTheme.load();

    document.getElementById('themeToggler').addEventListener('click', function() {
        if(appTheme.actual == 'dark') {
            appTheme.set('light', 500)
        } else {
            appTheme.set('dark', 500)
        }
    })

    document.querySelectorAll('.url-input').forEach(input=> {
        input.addEventListener('keyup', function() {
            this.value = removeDiacritics(this.value);
        })
    });
    document.querySelectorAll('a').forEach(link=>{
        if(!link.getAttribute("href")) return
        if(link.getAttribute("href").charAt(0) =='#') {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute("href")).scrollIntoView({
                    behavior: "smooth"
                });
            });
        } else {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.body.classList.remove('loaded');
                // document.getElementById('maskLeave').classList.add('active');
                setTimeout(function() {
                    console.log(link);
                    document.location = link.href;
                }, 250);
            });
        }
    
    })    

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
    document.querySelectorAll('.quillContent').forEach(div=>{
        let content = div.innerHTML.trim();
        try {
            let quill = new Quill(div, {
                modules: {
                    toolbar: false
                },
                readOnly: true,
                theme: 'snow'  // or 'bubble'
            });
            quill.setContents(JSON.parse(content));
            
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

})
