(()=>{"use strict";var e={n:t=>{var a=t&&t.__esModule?()=>t.default:()=>t;return e.d(a,{a}),a},d:(t,a)=>{for(var n in a)e.o(a,n)&&!e.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:a[n]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t)};const t=window.jQuery;var a=e.n(t);const n=a()("body"),s=a()(document),o=a()("#vp_preview");document.addEventListener("click",(e=>{e.stopPropagation(),e.preventDefault(),window.parentIFrame&&window.parentIFrame.sendMessage("clicked")}),!0),document.addEventListener("mousedown",(e=>{e.stopPropagation(),e.preventDefault(),e.target.blur(),window.focus()}),!0),s.on("startLoadingNewItems.vpf",((e,t,a,n)=>{"vpf"===e.namespace&&(n.data=Object.assign(n.data||{},window.vp_preview_post_data))}));const r={};window.iFrameResizer={log:!1,heightCalculationMethod:()=>o.outerHeight(!0),onMessage(e){if(e&&e.name)switch(e.name){case"resize":n.css("max-width",e.width+Math.random());break;case"dynamic-css":{const t=`vp-dynamic-styles-${e.blockId}-inline-css`;if(r[t]&&e.styles===r[t])break;let n=a()(`#${t}`);n.length||(n=a()(`<style id="${t}"></style>`).appendTo("head")),r[t]=e.styles,n.text(e.styles);break}}}}})();