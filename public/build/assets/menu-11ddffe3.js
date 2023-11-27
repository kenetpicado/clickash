import{z as ne,A as re,F as le,B as V,C as G,r as y,D as q,E as P,G as S,l as I,H as D,I as ue}from"./app-04f6af3f.js";function F(e,n,...r){if(e in n){let t=n[e];return typeof t=="function"?t(...r):t}let l=new Error(`Tried to handle "${e}" but there is no handler defined. Only defined handlers are: ${Object.keys(n).map(t=>`"${t}"`).join(", ")}.`);throw Error.captureStackTrace&&Error.captureStackTrace(l,F),l}var R=(e=>(e[e.None=0]="None",e[e.RenderStrategy=1]="RenderStrategy",e[e.Static=2]="Static",e))(R||{}),ae=(e=>(e[e.Unmount=0]="Unmount",e[e.Hidden=1]="Hidden",e))(ae||{});function O({visible:e=!0,features:n=0,ourProps:r,theirProps:l,...t}){var u;let o=Y(l,r),i=Object.assign(t,{props:o});if(e||n&2&&o.static)return A(i);if(n&1){let p=(u=o.unmount)==null||u?0:1;return F(p,{0(){return null},1(){return A({...t,props:{...o,hidden:!0,style:{display:"none"}}})}})}return A(i)}function A({props:e,attrs:n,slots:r,slot:l,name:t}){var u,o;let{as:i,...p}=oe(e,["unmount","static"]),c=(u=r.default)==null?void 0:u.call(r,l),a={};if(l){let m=!1,f=[];for(let[v,d]of Object.entries(l))typeof d=="boolean"&&(m=!0),d===!0&&f.push(v);m&&(a["data-headlessui-state"]=f.join(" "))}if(i==="template"){if(c=X(c??[]),Object.keys(p).length>0||Object.keys(n).length>0){let[m,...f]=c??[];if(!ie(m)||f.length>0)throw new Error(['Passing props on "template"!',"",`The current component <${t} /> is rendering a "template".`,"However we need to passthrough the following props:",Object.keys(p).concat(Object.keys(n)).map(s=>s.trim()).filter((s,h,E)=>E.indexOf(s)===h).sort((s,h)=>s.localeCompare(h)).map(s=>`  - ${s}`).join(`
`),"","You can apply a few solutions:",['Add an `as="..."` prop, to ensure that we render an actual element instead of a "template".',"Render a single element as the child so that we can forward the props onto that element."].map(s=>`  - ${s}`).join(`
`)].join(`
`));let v=Y((o=m.props)!=null?o:{},p),d=ne(m,v);for(let s in v)s.startsWith("on")&&(d.props||(d.props={}),d.props[s]=v[s]);return d}return Array.isArray(c)&&c.length===1?c[0]:c}return re(i,Object.assign({},p,a),{default:()=>c})}function X(e){return e.flatMap(n=>n.type===le?X(n.children):[n])}function Y(...e){if(e.length===0)return{};if(e.length===1)return e[0];let n={},r={};for(let l of e)for(let t in l)t.startsWith("on")&&typeof l[t]=="function"?(r[t]!=null||(r[t]=[]),r[t].push(l[t])):n[t]=l[t];if(n.disabled||n["aria-disabled"])return Object.assign(n,Object.fromEntries(Object.keys(r).map(l=>[l,void 0])));for(let l in r)Object.assign(n,{[l](t,...u){let o=r[l];for(let i of o){if(t instanceof Event&&t.defaultPrevented)return;i(t,...u)}}});return n}function oe(e,n=[]){let r=Object.assign({},e);for(let l of n)l in r&&delete r[l];return r}function ie(e){return e==null?!1:typeof e.type=="string"||typeof e.type=="object"||typeof e.type=="function"}let se=0;function ce(){return++se}function $(){return ce()}var g=(e=>(e.Space=" ",e.Enter="Enter",e.Escape="Escape",e.Backspace="Backspace",e.Delete="Delete",e.ArrowLeft="ArrowLeft",e.ArrowUp="ArrowUp",e.ArrowRight="ArrowRight",e.ArrowDown="ArrowDown",e.Home="Home",e.End="End",e.PageUp="PageUp",e.PageDown="PageDown",e.Tab="Tab",e))(g||{});function de(e){throw new Error("Unexpected object: "+e)}var w=(e=>(e[e.First=0]="First",e[e.Previous=1]="Previous",e[e.Next=2]="Next",e[e.Last=3]="Last",e[e.Specific=4]="Specific",e[e.Nothing=5]="Nothing",e))(w||{});function fe(e,n){let r=n.resolveItems();if(r.length<=0)return null;let l=n.resolveActiveIndex(),t=l??-1,u=(()=>{switch(e.focus){case 0:return r.findIndex(o=>!n.resolveDisabled(o));case 1:{let o=r.slice().reverse().findIndex((i,p,c)=>t!==-1&&c.length-p-1>=t?!1:!n.resolveDisabled(i));return o===-1?o:r.length-1-o}case 2:return r.findIndex((o,i)=>i<=t?!1:!n.resolveDisabled(o));case 3:{let o=r.slice().reverse().findIndex(i=>!n.resolveDisabled(i));return o===-1?o:r.length-1-o}case 4:return r.findIndex(o=>n.resolveId(o)===e.id);case 5:return null;default:de(e)}})();return u===-1?l:u}function b(e){var n;return e==null||e.value==null?null:(n=e.value.$el)!=null?n:e.value}let Q=Symbol("Context");var x=(e=>(e[e.Open=1]="Open",e[e.Closed=2]="Closed",e[e.Closing=4]="Closing",e[e.Opening=8]="Opening",e))(x||{});function ve(){return V(Q,null)}function pe(e){G(Q,e)}function U(e,n){if(e)return e;let r=n??"button";if(typeof r=="string"&&r.toLowerCase()==="button")return"button"}function me(e,n){let r=y(U(e.value.type,e.value.as));return q(()=>{r.value=U(e.value.type,e.value.as)}),P(()=>{var l;r.value||b(n)&&b(n)instanceof HTMLButtonElement&&!((l=b(n))!=null&&l.hasAttribute("type"))&&(r.value="button")}),r}var be=Object.defineProperty,he=(e,n,r)=>n in e?be(e,n,{enumerable:!0,configurable:!0,writable:!0,value:r}):e[n]=r,B=(e,n,r)=>(he(e,typeof n!="symbol"?n+"":n,r),r);class ge{constructor(){B(this,"current",this.detect()),B(this,"currentId",0)}set(n){this.current!==n&&(this.currentId=0,this.current=n)}reset(){this.set(this.detect())}nextId(){return++this.currentId}get isServer(){return this.current==="server"}get isClient(){return this.current==="client"}detect(){return typeof window>"u"||typeof document>"u"?"server":"client"}}let L=new ge;function j(e){if(L.isServer)return null;if(e instanceof Node)return e.ownerDocument;if(e!=null&&e.hasOwnProperty("value")){let n=b(e);if(n)return n.ownerDocument}return document}function ye({container:e,accept:n,walk:r,enabled:l}){P(()=>{let t=e.value;if(!t||l!==void 0&&!l.value)return;let u=j(e);if(!u)return;let o=Object.assign(p=>n(p),{acceptNode:n}),i=u.createTreeWalker(t,NodeFilter.SHOW_ELEMENT,o,!1);for(;i.nextNode();)r(i.currentNode)})}let N=["[contentEditable=true]","[tabindex]","a[href]","area[href]","button:not([disabled])","iframe","input:not([disabled])","select:not([disabled])","textarea:not([disabled])"].map(e=>`${e}:not([tabindex='-1'])`).join(",");var k=(e=>(e[e.First=1]="First",e[e.Previous=2]="Previous",e[e.Next=4]="Next",e[e.Last=8]="Last",e[e.WrapAround=16]="WrapAround",e[e.NoScroll=32]="NoScroll",e))(k||{}),we=(e=>(e[e.Error=0]="Error",e[e.Overflow=1]="Overflow",e[e.Success=2]="Success",e[e.Underflow=3]="Underflow",e))(we||{}),Ie=(e=>(e[e.Previous=-1]="Previous",e[e.Next=1]="Next",e))(Ie||{});function z(e=document.body){return e==null?[]:Array.from(e.querySelectorAll(N)).sort((n,r)=>Math.sign((n.tabIndex||Number.MAX_SAFE_INTEGER)-(r.tabIndex||Number.MAX_SAFE_INTEGER)))}var C=(e=>(e[e.Strict=0]="Strict",e[e.Loose=1]="Loose",e))(C||{});function H(e,n=0){var r;return e===((r=j(e))==null?void 0:r.body)?!1:F(n,{0(){return e.matches(N)},1(){let l=e;for(;l!==null;){if(l.matches(N))return!0;l=l.parentElement}return!1}})}function J(e){let n=j(e);S(()=>{n&&!H(n.activeElement,0)&&Se(e)})}var Ee=(e=>(e[e.Keyboard=0]="Keyboard",e[e.Mouse=1]="Mouse",e))(Ee||{});typeof window<"u"&&typeof document<"u"&&(document.addEventListener("keydown",e=>{e.metaKey||e.altKey||e.ctrlKey||(document.documentElement.dataset.headlessuiFocusVisible="")},!0),document.addEventListener("click",e=>{e.detail===1?delete document.documentElement.dataset.headlessuiFocusVisible:e.detail===0&&(document.documentElement.dataset.headlessuiFocusVisible="")},!0));function Se(e){e==null||e.focus({preventScroll:!0})}let xe=["textarea","input"].join(",");function Pe(e){var n,r;return(r=(n=e==null?void 0:e.matches)==null?void 0:n.call(e,xe))!=null?r:!1}function Z(e,n=r=>r){return e.slice().sort((r,l)=>{let t=n(r),u=n(l);if(t===null||u===null)return 0;let o=t.compareDocumentPosition(u);return o&Node.DOCUMENT_POSITION_FOLLOWING?-1:o&Node.DOCUMENT_POSITION_PRECEDING?1:0})}function Me(e,n){return De(z(),n,{relativeTo:e})}function De(e,n,{sorted:r=!0,relativeTo:l=null,skipElements:t=[]}={}){var u;let o=(u=Array.isArray(e)?e.length>0?e[0].ownerDocument:document:e==null?void 0:e.ownerDocument)!=null?u:document,i=Array.isArray(e)?r?Z(e):e:z(e);t.length>0&&i.length>1&&(i=i.filter(d=>!t.includes(d))),l=l??o.activeElement;let p=(()=>{if(n&5)return 1;if(n&10)return-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),c=(()=>{if(n&1)return 0;if(n&2)return Math.max(0,i.indexOf(l))-1;if(n&4)return Math.max(0,i.indexOf(l))+1;if(n&8)return i.length-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),a=n&32?{preventScroll:!0}:{},m=0,f=i.length,v;do{if(m>=f||m+f<=0)return 0;let d=c+m;if(n&16)d=(d+f)%f;else{if(d<0)return 3;if(d>=f)return 1}v=i[d],v==null||v.focus(a),m+=p}while(v!==o.activeElement);return n&6&&Pe(v)&&v.select(),2}function M(e,n,r){L.isServer||P(l=>{document.addEventListener(e,n,r),l(()=>document.removeEventListener(e,n,r))})}function Fe(e,n,r){L.isServer||P(l=>{window.addEventListener(e,n,r),l(()=>window.removeEventListener(e,n,r))})}function Oe(e,n,r=I(()=>!0)){function l(u,o){if(!r.value||u.defaultPrevented)return;let i=o(u);if(i===null||!i.getRootNode().contains(i))return;let p=function c(a){return typeof a=="function"?c(a()):Array.isArray(a)||a instanceof Set?a:[a]}(e);for(let c of p){if(c===null)continue;let a=c instanceof HTMLElement?c:b(c);if(a!=null&&a.contains(i)||u.composed&&u.composedPath().includes(a))return}return!H(i,C.Loose)&&i.tabIndex!==-1&&u.preventDefault(),n(u,i)}let t=y(null);M("pointerdown",u=>{var o,i;r.value&&(t.value=((i=(o=u.composedPath)==null?void 0:o.call(u))==null?void 0:i[0])||u.target)},!0),M("mousedown",u=>{var o,i;r.value&&(t.value=((i=(o=u.composedPath)==null?void 0:o.call(u))==null?void 0:i[0])||u.target)},!0),M("click",u=>{t.value&&(l(u,()=>t.value),t.value=null)},!0),M("touchend",u=>l(u,()=>u.target instanceof HTMLElement?u.target:null),!0),Fe("blur",u=>l(u,()=>window.document.activeElement instanceof HTMLIFrameElement?window.document.activeElement:null),!0)}function _(e){return[e.screenX,e.screenY]}function Te(){let e=y([-1,-1]);return{wasMoved(n){let r=_(n);return e.value[0]===r[0]&&e.value[1]===r[1]?!1:(e.value=r,!0)},update(n){e.value=_(n)}}}let K=/([\u2700-\u27BF]|[\uE000-\uF8FF]|\uD83C[\uDC00-\uDFFF]|\uD83D[\uDC00-\uDFFF]|[\u2011-\u26FF]|\uD83E[\uDD10-\uDDFF])/g;function W(e){var n,r;let l=(n=e.innerText)!=null?n:"",t=e.cloneNode(!0);if(!(t instanceof HTMLElement))return l;let u=!1;for(let i of t.querySelectorAll('[hidden],[aria-hidden],[role="img"]'))i.remove(),u=!0;let o=u?(r=t.innerText)!=null?r:"":l;return K.test(o)&&(o=o.replace(K,"")),o}function Ae(e){let n=e.getAttribute("aria-label");if(typeof n=="string")return n.trim();let r=e.getAttribute("aria-labelledby");if(r){let l=r.split(" ").map(t=>{let u=document.getElementById(t);if(u){let o=u.getAttribute("aria-label");return typeof o=="string"?o.trim():W(u).trim()}return null}).filter(Boolean);if(l.length>0)return l.join(", ")}return W(e).trim()}function Re(e){let n=y(""),r=y("");return()=>{let l=b(e);if(!l)return"";let t=l.innerText;if(n.value===t)return r.value;let u=Ae(l).trim().toLowerCase();return n.value=t,r.value=u,u}}var Ne=(e=>(e[e.Open=0]="Open",e[e.Closed=1]="Closed",e))(Ne||{}),ke=(e=>(e[e.Pointer=0]="Pointer",e[e.Other=1]="Other",e))(ke||{});function $e(e){requestAnimationFrame(()=>requestAnimationFrame(e))}let ee=Symbol("MenuContext");function T(e){let n=V(ee,null);if(n===null){let r=new Error(`<${e} /> is missing a parent <Menu /> component.`);throw Error.captureStackTrace&&Error.captureStackTrace(r,T),r}return n}let je=D({name:"Menu",props:{as:{type:[Object,String],default:"template"}},setup(e,{slots:n,attrs:r}){let l=y(1),t=y(null),u=y(null),o=y([]),i=y(""),p=y(null),c=y(1);function a(f=v=>v){let v=p.value!==null?o.value[p.value]:null,d=Z(f(o.value.slice()),h=>b(h.dataRef.domRef)),s=v?d.indexOf(v):null;return s===-1&&(s=null),{items:d,activeItemIndex:s}}let m={menuState:l,buttonRef:t,itemsRef:u,items:o,searchQuery:i,activeItemIndex:p,activationTrigger:c,closeMenu:()=>{l.value=1,p.value=null},openMenu:()=>l.value=0,goToItem(f,v,d){let s=a(),h=fe(f===w.Specific?{focus:w.Specific,id:v}:{focus:f},{resolveItems:()=>s.items,resolveActiveIndex:()=>s.activeItemIndex,resolveId:E=>E.id,resolveDisabled:E=>E.dataRef.disabled});i.value="",p.value=h,c.value=d??1,o.value=s.items},search(f){let v=i.value!==""?0:1;i.value+=f.toLowerCase();let d=(p.value!==null?o.value.slice(p.value+v).concat(o.value.slice(0,p.value+v)):o.value).find(h=>h.dataRef.textValue.startsWith(i.value)&&!h.dataRef.disabled),s=d?o.value.indexOf(d):-1;s===-1||s===p.value||(p.value=s,c.value=1)},clearSearch(){i.value=""},registerItem(f,v){let d=a(s=>[...s,{id:f,dataRef:v}]);o.value=d.items,p.value=d.activeItemIndex,c.value=1},unregisterItem(f){let v=a(d=>{let s=d.findIndex(h=>h.id===f);return s!==-1&&d.splice(s,1),d});o.value=v.items,p.value=v.activeItemIndex,c.value=1}};return Oe([t,u],(f,v)=>{var d;m.closeMenu(),H(v,C.Loose)||(f.preventDefault(),(d=b(t))==null||d.focus())},I(()=>l.value===0)),G(ee,m),pe(I(()=>F(l.value,{0:x.Open,1:x.Closed}))),()=>{let f={open:l.value===0,close:m.closeMenu};return O({ourProps:{},theirProps:e,slot:f,slots:n,attrs:r,name:"Menu"})}}}),Ce=D({name:"MenuButton",props:{disabled:{type:Boolean,default:!1},as:{type:[Object,String],default:"button"},id:{type:String,default:()=>`headlessui-menu-button-${$()}`}},setup(e,{attrs:n,slots:r,expose:l}){let t=T("MenuButton");l({el:t.buttonRef,$el:t.buttonRef});function u(c){switch(c.key){case g.Space:case g.Enter:case g.ArrowDown:c.preventDefault(),c.stopPropagation(),t.openMenu(),S(()=>{var a;(a=b(t.itemsRef))==null||a.focus({preventScroll:!0}),t.goToItem(w.First)});break;case g.ArrowUp:c.preventDefault(),c.stopPropagation(),t.openMenu(),S(()=>{var a;(a=b(t.itemsRef))==null||a.focus({preventScroll:!0}),t.goToItem(w.Last)});break}}function o(c){switch(c.key){case g.Space:c.preventDefault();break}}function i(c){e.disabled||(t.menuState.value===0?(t.closeMenu(),S(()=>{var a;return(a=b(t.buttonRef))==null?void 0:a.focus({preventScroll:!0})})):(c.preventDefault(),t.openMenu(),$e(()=>{var a;return(a=b(t.itemsRef))==null?void 0:a.focus({preventScroll:!0})})))}let p=me(I(()=>({as:e.as,type:n.type})),t.buttonRef);return()=>{var c;let a={open:t.menuState.value===0},{id:m,...f}=e,v={ref:t.buttonRef,id:m,type:p.value,"aria-haspopup":"menu","aria-controls":(c=b(t.itemsRef))==null?void 0:c.id,"aria-expanded":t.menuState.value===0,onKeydown:u,onKeyup:o,onClick:i};return O({ourProps:v,theirProps:f,slot:a,attrs:n,slots:r,name:"MenuButton"})}}}),He=D({name:"MenuItems",props:{as:{type:[Object,String],default:"div"},static:{type:Boolean,default:!1},unmount:{type:Boolean,default:!0},id:{type:String,default:()=>`headlessui-menu-items-${$()}`}},setup(e,{attrs:n,slots:r,expose:l}){let t=T("MenuItems"),u=y(null);l({el:t.itemsRef,$el:t.itemsRef}),ye({container:I(()=>b(t.itemsRef)),enabled:I(()=>t.menuState.value===0),accept(a){return a.getAttribute("role")==="menuitem"?NodeFilter.FILTER_REJECT:a.hasAttribute("role")?NodeFilter.FILTER_SKIP:NodeFilter.FILTER_ACCEPT},walk(a){a.setAttribute("role","none")}});function o(a){var m;switch(u.value&&clearTimeout(u.value),a.key){case g.Space:if(t.searchQuery.value!=="")return a.preventDefault(),a.stopPropagation(),t.search(a.key);case g.Enter:if(a.preventDefault(),a.stopPropagation(),t.activeItemIndex.value!==null){let f=t.items.value[t.activeItemIndex.value];(m=b(f.dataRef.domRef))==null||m.click()}t.closeMenu(),J(b(t.buttonRef));break;case g.ArrowDown:return a.preventDefault(),a.stopPropagation(),t.goToItem(w.Next);case g.ArrowUp:return a.preventDefault(),a.stopPropagation(),t.goToItem(w.Previous);case g.Home:case g.PageUp:return a.preventDefault(),a.stopPropagation(),t.goToItem(w.First);case g.End:case g.PageDown:return a.preventDefault(),a.stopPropagation(),t.goToItem(w.Last);case g.Escape:a.preventDefault(),a.stopPropagation(),t.closeMenu(),S(()=>{var f;return(f=b(t.buttonRef))==null?void 0:f.focus({preventScroll:!0})});break;case g.Tab:a.preventDefault(),a.stopPropagation(),t.closeMenu(),S(()=>Me(b(t.buttonRef),a.shiftKey?k.Previous:k.Next));break;default:a.key.length===1&&(t.search(a.key),u.value=setTimeout(()=>t.clearSearch(),350));break}}function i(a){switch(a.key){case g.Space:a.preventDefault();break}}let p=ve(),c=I(()=>p!==null?(p.value&x.Open)===x.Open:t.menuState.value===0);return()=>{var a,m;let f={open:t.menuState.value===0},{id:v,...d}=e,s={"aria-activedescendant":t.activeItemIndex.value===null||(a=t.items.value[t.activeItemIndex.value])==null?void 0:a.id,"aria-labelledby":(m=b(t.buttonRef))==null?void 0:m.id,id:v,onKeydown:o,onKeyup:i,role:"menu",tabIndex:0,ref:t.itemsRef};return O({ourProps:s,theirProps:d,slot:f,attrs:n,slots:r,features:R.RenderStrategy|R.Static,visible:c.value,name:"MenuItems"})}}}),Ue=D({name:"MenuItem",inheritAttrs:!1,props:{as:{type:[Object,String],default:"template"},disabled:{type:Boolean,default:!1},id:{type:String,default:()=>`headlessui-menu-item-${$()}`}},setup(e,{slots:n,attrs:r,expose:l}){let t=T("MenuItem"),u=y(null);l({el:u,$el:u});let o=I(()=>t.activeItemIndex.value!==null?t.items.value[t.activeItemIndex.value].id===e.id:!1),i=Re(u),p=I(()=>({disabled:e.disabled,get textValue(){return i()},domRef:u}));q(()=>t.registerItem(e.id,p)),ue(()=>t.unregisterItem(e.id)),P(()=>{t.menuState.value===0&&o.value&&t.activationTrigger.value!==0&&S(()=>{var s,h;return(h=(s=b(u))==null?void 0:s.scrollIntoView)==null?void 0:h.call(s,{block:"nearest"})})});function c(s){if(e.disabled)return s.preventDefault();t.closeMenu(),J(b(t.buttonRef))}function a(){if(e.disabled)return t.goToItem(w.Nothing);t.goToItem(w.Specific,e.id)}let m=Te();function f(s){m.update(s)}function v(s){m.wasMoved(s)&&(e.disabled||o.value||t.goToItem(w.Specific,e.id,0))}function d(s){m.wasMoved(s)&&(e.disabled||o.value&&t.goToItem(w.Nothing))}return()=>{let{disabled:s}=e,h={active:o.value,disabled:s,close:t.closeMenu},{id:E,...te}=e;return O({ourProps:{id:E,ref:u,role:"menuitem",tabIndex:s===!0?void 0:-1,"aria-disabled":s===!0?!0:void 0,disabled:void 0,onClick:c,onFocus:a,onPointerenter:f,onMouseenter:f,onPointermove:v,onMousemove:v,onPointerleave:d,onMouseleave:d},theirProps:{...r,...te},slot:h,attrs:r,slots:n,name:"MenuItem"})}}});export{je as M,Ce as R,He as h,Ue as y};
