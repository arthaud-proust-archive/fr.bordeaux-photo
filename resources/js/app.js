require('./bootstrap');
const Theme = require('./theme');

require('alpinejs');


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
        '--t1': 'rgb(91,25,153)',
        '--t2': 'rgb(109,28,185)',
        '--t0': 'rgb(184,31,31)',
    },
    light:{
        '--p1': 'rgb(12,12,15)',
        '--p2': 'rgb(39,39,39)',
        '--p3': 'rgb(97,97,97)',
        '--si': 'rgb(245,245,245)',
        '--s0': 'rgb(255,255,255)',
        '--s1': 'rgb(245,245,245)',
        '--s2': 'rgb(236,236,236)',
        '--s3': 'rgb(216, 216, 216)',
        '--t1': 'rgb(165,96,230)',
        '--t2': 'rgb(126,17,228)',
        '--t0': 'rgb(230,84,84)',
    },
}

// var e = '{\n';
// Object.entries(themeColors).forEach(function(t){
//     e+=`${t[0]}:{`
//     Object.entries(t[1]).forEach(function(c){
//         e+=`\n '${c[0]}': 'rgb(${c[1].r},${c[1].g},${c[1].b})',`
//     })
//     e+=`\n},\n`
// })
// e+=`}`
// console.log(e);

document.addEventListener('DOMContentLoaded', function() {

    const appTheme = new Theme(themeColors, {
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
})


document.querySelectorAll('a').forEach(link=>{
    console.log(link.getAttribute("href"));
    if(link.getAttribute("href").charAt(0) =='#') {
        link.onclick = function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute("href")).scrollIntoView({
                behavior: "smooth"
            });
        }
    } else {
        link.onclick = function(e) {
            e.preventDefault();
            document.body.classList.remove('loaded');
            // document.getElementById('maskLeave').classList.add('active');
            setTimeout(function() {
                console.log(link);
                document.location = link.href;
            }, 250);
            // Cancel the event as stated by the standard.
        }
    }

})