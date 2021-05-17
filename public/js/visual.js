(()=>{function t(t){return function(t){if(Array.isArray(t))return e(t)}(t)||function(t){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(t))return Array.from(t)}(t)||function(t,o){if(!t)return;if("string"==typeof t)return e(t,o);var n=Object.prototype.toString.call(t).slice(8,-1);"Object"===n&&t.constructor&&(n=t.constructor.name);if("Map"===n||"Set"===n)return Array.from(t);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return e(t,o)}(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function e(t,e){(null==e||e>t.length)&&(e=t.length);for(var o=0,n=new Array(e);o<e;o++)n[o]=t[o];return n}var o=document.querySelectorAll(".visual.laureat"),r=document.querySelectorAll(".visual.event"),a=document.querySelectorAll(".visual.custom"),i=4096,c=3276.8;function l(e){var o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"",r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:400;if(""==o)return{content:[o],font:"".concat(a,"px sans-serif")};var a=r,i=[o],c=!1;for(e.textBaseline="top";!c;){c=!0,e.font="".concat(a,"px sans-serif");for(var l=0;l<i.length;l++)if(w=e.measureText(i[l]).width,w+500>3596){wLetter=w/i[l].length,lMax=Math.floor(3096/wLetter);for(var f=lMax;" "!==i[l].charAt(f)&&f>0;)f--;if(0==f){a-=10,c=!1;break}n=i.indexOf(i[l]),i=[].concat(t(i.slice(0,n)),[i[l].slice(0,f),i[l].slice(f+1)],t(i.slice(n+1))),c=!1;break}}return{content:i,font:"".concat(a,"px sans-serif")}}function f(t,e,o,n){var r=arguments.length>4&&void 0!==arguments[4]?arguments[4]:function(){},a=t.querySelector("canvas"),c=a,l=c.cloneNode(!0);c.parentNode.replaceChild(l,c),(a=t.querySelector("canvas")).height=a.width=i;var f=a.getContext("2d");f.fillStyle=e.s1,f.fillRect(0,0,i,i),f.fillStyle=e.p1,f.font="110px sans-serif";var d=o.top||"",s=f.measureText(d);f.fillRect(0,150,i-(400+s.width),10),f.fillText(d,i-(350+s.width),190),f.fillRect(3796,150,300,10),f.font="180px sans-serif",outerLeft_Txt=o.left||"",outerLeft_Coords=f.measureText(outerLeft_Txt),outerRightTxt=o.right||"",outerBottom_Txt=o.bottom||"",outerRightCoords=f.measureText(outerRightTxt),outerBottom_Coords=f.measureText(outerBottom_Txt),f.rotate(-Math.PI/2),f.fillRect(-4096,150,300,10),f.fillText(outerLeft_Txt,-3696,200),f.fillRect(-3596+outerLeft_Coords.width,150,i-(100+outerLeft_Coords.width),10),f.rotate(Math.PI),f.fillRect(0,-3946,300,10),f.fillText(outerRightTxt,400,-3876),f.fillRect(500+outerRightCoords.width,-3946,i-(100+outerRightCoords.width),10),f.rotate(-Math.PI/2),f.fillRect(0,3946,300,10),f.fillText(outerBottom_Txt,400,3996),f.fillRect(500+outerBottom_Coords.width,3946,i-(100+outerBottom_Coords.width),10),a.addEventListener("click",(function(){u(this,n)})),a.addEventListener("contextmenu",(function(t){t.preventDefault(),u(this,n)})),a.parentElement.addEventListener("mouseenter",(function(){this.classList.remove("downloaded")})),r(t,a,f,e)}function u(t,e){t.parentElement.classList.add("downloaded");var o="image/jpeg",n=t.toDataURL(o),r=document.createElement("a");r.download=e+".jpg",r.href=n,r.dataset.downloadurl=[o,r.download,r.href].join(":"),document.body.appendChild(r),r.click(),document.body.removeChild(r)}String.prototype.capitalize=function(){return this.charAt(0).toUpperCase()+this.slice(1)},a.forEach((function(t){var e={p1:"#ffffff",s1:"#0d0d0e"},o={},n={top:"@photo_a_bordeaux"},r="visuel-personnalise",a={},c={};["p1","s1"].forEach((function(t){o[t]=document.getElementById("visual_".concat(t)),o[t].addEventListener("change",(function(){["p1","s1"].forEach((function(t){e[t]=o[t].value,u()}))}))})),["left","bottom","right"].forEach((function(t){o[t]=document.getElementById("visual_outer".concat(t.capitalize())),o[t].addEventListener("keyup",(function(){["left","bottom","right"].forEach((function(t){n[t]=o[t].value,u()}))}))})),["title","content"].forEach((function(t){a[t]=document.getElementById("visual_".concat(t)),a[t].addEventListener("keyup",(function(){u()}))}));var u=function(){["title","content"].forEach((function(o){c[o]=a[o].value,f(t,e,n,r,(function(t,e,o,n){var r=l(o,c.title,400),a=l(o,c.content,180),f=400*r.content.length+200*a.content.length,u=(i-f-300)/2;o.font=r.font;for(var d=0;d<r.content.length;d++)o.fillText(r.content[d],500,u+400*d);o.font=a.font;for(var s=0;s<a.content.length;s++)o.fillText(a.content[s],500,u+400*r.content.length+100+200*s)}))}))};f(t,e,n,r)})),o.forEach((function(t){var e={top:"@photo_a_bordeaux",bottom:JSON.parse(t.dataset.laureats).join(" - "),left:"Par ".concat(t.dataset.author),right:"Thème ".concat(t.dataset.event)};f(t,{p1:"#ffffff",s1:"#0d0d0e"},e,"".concat(t.dataset.event," - ").concat(e.bottom),(function(t,e,o,n){!function(t,e){var o,n,r,a,l,f=arguments.length>2&&void 0!==arguments[2]?arguments[2]:function(){},u=new Image;u.addEventListener("load",(function(){u.width==u.height?(o=1,a=l=c):u.width<u.height?(o=u.width/u.height,l=c,a=c*o):(o=u.height/u.width,l=c*o,a=c),n=(i-a)/2,r=(i-l)/2,e.drawImage(u,n,r,a,l),f()}),!1),u.src=t.dataset.image}(t,o)}))})),r.forEach((function(t){f(t,{p1:"#0d0d0e",s1:"#ffffff"},{top:"@photo_a_bordeaux",right:"Participez sur bordeaux-photo.fr",bottom:"Partage et commente !"},t.dataset.theme,(function(t,e,o,n){var r=t.dataset.type.capitalize(),a=o.measureText(r);o.fillText(r,500,1e3),function(t,e,o){var n=new Image;n.addEventListener("load",(function(){e.drawImage(n,500+o.width+50,840,200,200)}),!1),n.src=t.dataset.typeicon}(t,o,a),o.fillText(t.dataset.dates,500,1250),o.fillText("Thème",500,2e3);for(var i=l(o,t.dataset.theme,400),c=0;c<i.content.length;c++)o.fillText(i.content[c],500,2100+400*c)}))}))})();