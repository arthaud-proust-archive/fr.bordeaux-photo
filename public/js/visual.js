/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/visual.js ***!
  \********************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var laureats = document.querySelectorAll('.visual.laureat');
var events = document.querySelectorAll('.visual.event');
var custom = document.querySelectorAll('.visual.custom');
var SIZE = 4096;
var IMG_SIZE = SIZE * 0.80;
var LAUREAT_SIZE = SIZE * 0.3;

String.prototype.capitalize = function () {
  return this.charAt(0).toUpperCase() + this.slice(1);
};

custom.forEach(function (visual) {
  var colors = {
    p1: "#ffffff",
    s1: "#0d0d0e"
  };
  var inputs = {};
  var outers = {
    top: '@photo_a_bordeaux'
  };
  var downloadName = 'visuel-personnalise';
  var infos = {};
  var infosContent = {};
  ['p1', 's1'].forEach(function (d) {
    inputs[d] = document.getElementById("visual_".concat(d));
    inputs[d].addEventListener('change', function () {
      return updt();
    });
  });
  ['left', 'bottom', 'right'].forEach(function (d) {
    inputs[d] = document.getElementById("visual_outer".concat(d.capitalize()));
    inputs[d].addEventListener('keyup', function () {
      return updt();
    });
  });
  ['title', 'content'].forEach(function (d) {
    infos[d] = document.getElementById("visual_".concat(d));
    infos[d].addEventListener('keyup', function () {
      return updt();
    });
  });

  var updt = function updt() {
    ['p1', 's1'].forEach(function (inputName) {
      colors[inputName] = inputs[inputName].value;
    });
    ['left', 'bottom', 'right'].forEach(function (inputName) {
      outers[inputName] = inputs[inputName].value;
    });
    ['title', 'content'].forEach(function (inputName) {
      infosContent[inputName] = infos[inputName].value;
      setupCanvas(visual, colors, outers, downloadName, function (visual, canvas, ctx, colors) {
        var titleTxt = getWrappedTxt(ctx, infosContent.title, 400);
        var contentTxt = getWrappedTxt(ctx, infosContent.content, 180);
        var txtH = titleTxt.content.length * 400 + contentTxt.content.length * 200;
        var dTop = (SIZE - txtH - 300) / 2;
        ctx.font = titleTxt.font;

        for (var line = 0; line < titleTxt.content.length; line++) {
          ctx.fillText(titleTxt.content[line], 500, dTop + line * 400);
        }

        ctx.font = contentTxt.font;

        for (var _line = 0; _line < contentTxt.content.length; _line++) {
          ctx.fillText(contentTxt.content[_line], 500, dTop + titleTxt.content.length * 400 + 100 + 200 * _line);
        }
      });
    });
  };

  updt(); // setupCanvas(visual, colors, outers, downloadName)
});
laureats.forEach(function (visual) {
  var colors = {
    p1: "#ffffff",
    s1: "#0d0d0e"
  };
  var outers = {
    top: '@photo_a_bordeaux',
    bottom: JSON.parse(visual.dataset.laureats).join(' - '),
    left: "Par ".concat(visual.dataset.author),
    right: "Th\xE8me ".concat(visual.dataset.event)
  };
  var downloadName = "".concat(visual.dataset.event, " - ").concat(outers.bottom);
  setupCanvas(visual, colors, outers, downloadName, function (visual, canvas, ctx, colors) {
    setImage(visual, ctx);
  });
});
events.forEach(function (visual) {
  var colors = {
    p1: "#0d0d0e",
    s1: "#ffffff"
  };
  var outers = {
    top: '@photo_a_bordeaux',
    right: 'Participez sur bordeaux-photo.fr',
    bottom: 'Partage et commente !'
  };
  var downloadName = visual.dataset.theme;
  setupCanvas(visual, colors, outers, downloadName, function (visual, canvas, ctx, colors) {
    var typeTxt = visual.dataset.type.capitalize();
    var typeCoords = ctx.measureText(typeTxt);
    ctx.fillText(typeTxt, 500, 1000);
    setTypeicon(visual, ctx, typeCoords);
    ctx.fillText(visual.dataset.dates, 500, 1250);
    ctx.fillText('Thème', 500, 2000);
    var themeTxt = getWrappedTxt(ctx, visual.dataset.theme, 400);

    for (var line = 0; line < themeTxt.content.length; line++) {
      ctx.fillText(themeTxt.content[line], 500, 2100 + line * 400);
    }
  });
});

function getWrappedTxt(ctx) {
  var baseText = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
  var defaultFontSize = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 400;
  if (baseText == '') return {
    content: [baseText],
    font: "".concat(fontSize, "px sans-serif")
  };
  var fontSize = defaultFontSize;
  var linesTxt = [baseText];
  var textPrinted = false;
  ctx.textBaseline = 'top';

  while (!textPrinted) {
    textPrinted = true;
    ctx.font = "".concat(fontSize, "px sans-serif");

    for (var line = 0; line < linesTxt.length; line++) {
      w = ctx.measureText(linesTxt[line]).width;

      if (w + 500 > SIZE - 500) {
        wLetter = w / linesTxt[line].length; // largeur par lettre
        // on cherche le dernier espace avant la limite à droite

        lMax = Math.floor((SIZE - (500 + 500)) / wLetter);
        var iSpace = lMax;

        while ((linesTxt[line].charAt(iSpace) !== " " || linesTxt[line].charAt(iSpace) !== "\n") && iSpace > 0) {
          // recherche commence par la fin
          iSpace--;
        }

        if (iSpace == 0) {
          fontSize -= 10;
          textPrinted = false;
          break;
        }

        n = linesTxt.indexOf(linesTxt[line]);
        linesTxt = [].concat(_toConsumableArray(linesTxt.slice(0, n)), [linesTxt[line].slice(0, iSpace), linesTxt[line].slice(iSpace + 1)], _toConsumableArray(linesTxt.slice(n + 1)));
        textPrinted = false;
        break;
      } else {// ctx.fillText(titleTxt[line], 500, 500+line*400)
        // textPrinted=true;
      }
    }
  }

  return {
    content: linesTxt,
    font: "".concat(fontSize, "px sans-serif")
  };
}

function setupCanvas(visual, colors, outers, downloadName) {
  var toDoAfter = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : function () {};
  var canvas = visual.querySelector('canvas');
  var old_element = canvas;
  var new_element = old_element.cloneNode(true);
  old_element.parentNode.replaceChild(new_element, old_element);
  canvas = visual.querySelector('canvas');
  canvas.height = canvas.width = SIZE;
  var ctx = canvas.getContext("2d");
  ctx.fillStyle = colors.s1;
  ctx.fillRect(0, 0, SIZE, SIZE);
  ctx.fillStyle = colors.p1;
  ctx.font = '110px sans-serif';
  var outerTop_Txt = outers.top || '';
  var outerTop_Coords = ctx.measureText(outerTop_Txt);
  ctx.fillRect(0, 150, SIZE - (400 + outerTop_Coords.width), 10);
  ctx.fillText(outerTop_Txt, SIZE - (350 + outerTop_Coords.width), 190);
  ctx.fillRect(SIZE - 300, 150, 300, 10);
  ctx.font = '180px sans-serif';
  outerLeft_Txt = outers.left || '';
  outerLeft_Coords = ctx.measureText(outerLeft_Txt);
  outerRightTxt = outers.right || '';
  outerBottom_Txt = outers.bottom || '';
  outerRightCoords = ctx.measureText(outerRightTxt);
  outerBottom_Coords = ctx.measureText(outerBottom_Txt);
  ctx.rotate(-Math.PI / 2);
  ctx.fillRect(-SIZE, 150, 300, 10);
  ctx.fillText(outerLeft_Txt, -SIZE + 400, 200);
  ctx.fillRect(-SIZE + 500 + outerLeft_Coords.width, 150, SIZE - (100 + outerLeft_Coords.width), 10);
  ctx.rotate(Math.PI);
  ctx.fillRect(0, -SIZE + 150, 300, 10);
  ctx.fillText(outerRightTxt, 400, -SIZE + 220);
  ctx.fillRect(500 + outerRightCoords.width, -SIZE + 150, SIZE - (100 + outerRightCoords.width), 10);
  ctx.rotate(-Math.PI / 2);
  ctx.fillRect(0, SIZE - 150, 300, 10);
  ctx.fillText(outerBottom_Txt, 400, SIZE - 100);
  ctx.fillRect(500 + outerBottom_Coords.width, SIZE - 150, SIZE - (100 + outerBottom_Coords.width), 10);
  canvas.addEventListener('click', function () {
    exportCanvasAsJPG(this, downloadName);
  });
  canvas.addEventListener('contextmenu', function (e) {
    e.preventDefault();
    exportCanvasAsJPG(this, downloadName);
  });
  canvas.parentElement.addEventListener('mouseenter', function () {
    this.classList.remove('downloaded');
  });
  toDoAfter(visual, canvas, ctx, colors);
}

function setImage(visual, ctx) {
  var callback = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : function () {};
  var img = new Image();
  var ratio, spaceX, spaceY, w, h;
  img.addEventListener('load', function () {
    if (img.width == img.height) {
      ratio = 1;
      w = h = IMG_SIZE;
    } else if (img.width < img.height) {
      ratio = img.width / img.height;
      h = IMG_SIZE;
      w = IMG_SIZE * ratio;
    } else {
      ratio = img.height / img.width;
      h = IMG_SIZE * ratio;
      w = IMG_SIZE;
    }

    spaceX = (SIZE - w) / 2;
    spaceY = (SIZE - h) / 2;
    ctx.drawImage(img, spaceX, spaceY, w, h);
    callback();
  }, false);
  img.src = visual.dataset.image;
}

function setLaureats(visual, ctx) {
  var laureats = JSON.parse(visual.dataset.laureats);

  for (var i = 0; i < laureats.length; i++) {
    var img = new Image();
    img.addEventListener('load', function () {
      ratio = img.height / img.width;
      ctx.drawImage(img, (SIZE - LAUREAT_SIZE) / 2, SIZE - LAUREAT_SIZE, LAUREAT_SIZE, LAUREAT_SIZE * ratio);
    }, false);
    img.src = laureats[i];
  }
}

function setTypeicon(visual, ctx, typeCoords) {
  var img = new Image();
  img.addEventListener('load', function () {
    ctx.drawImage(img, 500 + typeCoords.width + 50, 840, 200, 200);
  }, false);
  img.src = visual.dataset.typeicon;
}

function exportCanvasAsJPG(canvasElement, fileName) {
  canvasElement.parentElement.classList.add('downloaded'); // var canvasElement = document.getElementById(id);

  var MIME_TYPE = "image/jpeg";
  var imgURL = canvasElement.toDataURL(MIME_TYPE);
  var dlLink = document.createElement('a');
  dlLink.download = fileName + '.jpg';
  dlLink.href = imgURL;
  dlLink.dataset.downloadurl = [MIME_TYPE, dlLink.download, dlLink.href].join(':');
  document.body.appendChild(dlLink);
  dlLink.click();
  document.body.removeChild(dlLink);
}
/******/ })()
;