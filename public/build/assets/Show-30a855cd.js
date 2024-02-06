import{_ as W}from"./StatCard-b273ec58.js";import{_ as Y}from"./ThePaginator-6b6d9959.js";import{_ as J,I as Q}from"./ClientareaLayout-73e9e689.js";import{_ as X}from"./Transaction-5595e3a0.js";import{_ as Z}from"./InputForm-e71775d0.js";import{n as w,r as m,k as u,p as L,q as B,s as ee,u as S,v as D,g as E,x as O,F as $,l as te,o as p,j as N,e as f,b as v,t as ae,a as h,c as k,h as P,f as le,y as j,O as re}from"./app-ff81f535.js";import{H as _,t as F,b as ne,o as se,K as oe,T as ie,a as T}from"./use-resolve-button-type-14ba3d6c.js";import"./IconUser-aede0555.js";import"./Carbon-e7b34390.js";var U=(e=>(e[e.None=1]="None",e[e.Focusable=2]="Focusable",e[e.Hidden=4]="Hidden",e))(U||{});let ue=w({name:"Hidden",props:{as:{type:[Object,String],default:"div"},features:{type:Number,default:1}},setup(e,{slots:n,attrs:s}){return()=>{let{features:t,...a}=e,l={"aria-hidden":(t&2)===2?!0:void 0,style:{position:"fixed",top:1,left:1,width:1,height:0,padding:0,margin:-1,overflow:"hidden",clip:"rect(0, 0, 0, 0)",whiteSpace:"nowrap",borderWidth:"0",...(t&4)===4&&(t&2)!==2&&{display:"none"}}};return _({ourProps:l,theirProps:a,slot:{},attrs:s,slots:n,name:"Hidden"})}}});function de(e){var n,s;let t=(n=e==null?void 0:e.form)!=null?n:e.closest("form");if(t){for(let a of t.elements)if(a!==e&&(a.tagName==="INPUT"&&a.type==="submit"||a.tagName==="BUTTON"&&a.type==="submit"||a.nodeName==="INPUT"&&a.type==="image")){a.click();return}(s=t.requestSubmit)==null||s.call(t)}}function ce(e,n,s){let t=m(s==null?void 0:s.value),a=u(()=>e.value!==void 0);return[u(()=>a.value?e.value:t.value),function(l){return a.value||(t.value=l),n==null?void 0:n(l)}]}let pe=Symbol("DescriptionContext");function me({slot:e=m({}),name:n="Description",props:s={}}={}){let t=m([]);function a(l){return t.value.push(l),()=>{let r=t.value.indexOf(l);r!==-1&&t.value.splice(r,1)}}return L(pe,{register:a,slot:e,name:n,props:s}),u(()=>t.value.length>0?t.value.join(" "):void 0)}let q=Symbol("LabelContext");function H(){let e=D(q,null);if(e===null){let n=new Error("You used a <Label /> component, but it is not inside a parent.");throw Error.captureStackTrace&&Error.captureStackTrace(n,H),n}return e}function fe({slot:e={},name:n="Label",props:s={}}={}){let t=m([]);function a(l){return t.value.push(l),()=>{let r=t.value.indexOf(l);r!==-1&&t.value.splice(r,1)}}return L(q,{register:a,slot:e,name:n,props:s}),u(()=>t.value.length>0?t.value.join(" "):void 0)}let ve=w({name:"Label",props:{as:{type:[Object,String],default:"label"},passive:{type:[Boolean],default:!1},id:{type:String,default:()=>`headlessui-label-${F()}`}},setup(e,{slots:n,attrs:s}){let t=H();return B(()=>ee(t.register(e.id))),()=>{let{name:a="Label",slot:l={},props:r={}}=t,{id:i,passive:y,...g}=e,d={...Object.entries(r).reduce((x,[C,V])=>Object.assign(x,{[C]:S(V)}),{}),id:i};return y&&(delete d.onClick,delete d.htmlFor,delete g.onClick),_({ourProps:d,theirProps:g,slot:l,attrs:s,slots:n,name:a})}}}),K=Symbol("GroupContext"),he=w({name:"SwitchGroup",props:{as:{type:[Object,String],default:"template"}},setup(e,{slots:n,attrs:s}){let t=m(null),a=fe({name:"SwitchLabel",props:{htmlFor:u(()=>{var r;return(r=t.value)==null?void 0:r.id}),onClick(r){t.value&&(r.currentTarget.tagName==="LABEL"&&r.preventDefault(),t.value.click(),t.value.focus({preventScroll:!0}))}}}),l=me({name:"SwitchDescription"});return L(K,{switchRef:t,labelledby:a,describedby:l}),()=>_({theirProps:e,ourProps:{},slot:{},slots:n,attrs:s,name:"SwitchGroup"})}}),ye=w({name:"Switch",emits:{"update:modelValue":e=>!0},props:{as:{type:[Object,String],default:"button"},modelValue:{type:Boolean,default:void 0},defaultChecked:{type:Boolean,optional:!0},form:{type:String,optional:!0},name:{type:String,optional:!0},value:{type:String,optional:!0},id:{type:String,default:()=>`headlessui-switch-${F()}`}},inheritAttrs:!1,setup(e,{emit:n,attrs:s,slots:t,expose:a}){let l=D(K,null),[r,i]=ce(u(()=>e.modelValue),o=>n("update:modelValue",o),u(()=>e.defaultChecked));function y(){i(!r.value)}let g=m(null),d=l===null?g:l.switchRef,x=ne(u(()=>({as:e.as,type:s.type})),d);a({el:d,$el:d});function C(o){o.preventDefault(),y()}function V(o){o.key===T.Space?(o.preventDefault(),y()):o.key===T.Enter&&de(o.currentTarget)}function I(o){o.preventDefault()}let b=u(()=>{var o,c;return(c=(o=se(d))==null?void 0:o.closest)==null?void 0:c.call(o,"form")});return B(()=>{E([b],()=>{if(!b.value||e.defaultChecked===void 0)return;function o(){i(e.defaultChecked)}return b.value.addEventListener("reset",o),()=>{var c;(c=b.value)==null||c.removeEventListener("reset",o)}},{immediate:!0})}),()=>{let{id:o,name:c,value:R,form:G,...A}=e,M={checked:r.value},z={id:o,ref:d,role:"switch",type:x.value,tabIndex:0,"aria-checked":r.value,"aria-labelledby":l==null?void 0:l.labelledby.value,"aria-describedby":l==null?void 0:l.describedby.value,onClick:C,onKeyup:V,onKeypress:I};return O($,[c!=null&&r.value!=null?O(ue,oe({features:U.Hidden,as:"input",type:"checkbox",hidden:!0,readOnly:!0,checked:r.value,form:G,name:c,value:R})):null,_({ourProps:z,theirProps:{...s,...ie(A,["modelValue","defaultChecked"])},slot:M,attrs:s,slots:t,name:"Switch"})])}}}),ge=ve;const be={class:"title"},ke={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600"},Se={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4"},we={class:"flex items-center mb-5"},_e={key:0,class:"w-full text-center text-gray-400"},xe={key:1,class:"grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4"},Be={__name:"Show",props:{seller:{type:Object,required:!0},transactions:{type:Object,required:!0},daily_transactions:{type:[Number,String],required:!0}},setup(e){const n=e,s=u(()=>[{title:a.date?"Ventas":"Ventas de hoy",value:"C$"+n.daily_transactions.toLocaleString(),icon:Q}]),t=new URLSearchParams(window.location.search),a=te({date:t.get("date")??"",trashed:!!t.get("trashed")});return E(()=>a,()=>{let l={...a};for(const r in l)l[r]||delete l[r];re.get(route("clientarea.sellers.show",n.seller.id),l,{preserveState:!0,preserveScroll:!0,only:["transactions","daily_transactions"],replace:!0})},{deep:!0}),(l,r)=>(p(),N(J,{title:"Ventas"},{header:f(()=>[v("span",be,ae(e.seller.name),1)]),default:f(()=>[v("div",ke,[h(Z,{modelValue:a.date,"onUpdate:modelValue":r[0]||(r[0]=i=>a.date=i),text:"Fecha",type:"date"},null,8,["modelValue"])]),v("div",Se,[(p(!0),k($,null,P(s.value,i=>(p(),N(W,{stat:i,key:i.title},null,8,["stat"]))),128))]),h(S(he),null,{default:f(()=>[v("div",we,[h(S(ge),{class:"mr-4 text-gray-400"},{default:f(()=>[le("Ver eliminadas")]),_:1}),h(S(ye),{modelValue:a.trashed,"onUpdate:modelValue":r[1]||(r[1]=i=>a.trashed=i),class:j([a.trashed?"bg-primary":"bg-gray-200","relative inline-flex h-6 w-11 items-center rounded-full transition-colors"])},{default:f(()=>[v("span",{class:j([a.trashed?"translate-x-6":"translate-x-1","inline-block h-4 w-4 transform rounded-full bg-white transition-transform"])},null,2)]),_:1},8,["modelValue","class"])])]),_:1}),e.transactions.data.length==0?(p(),k("div",_e," No hay transacciones ")):(p(),k("div",xe,[(p(!0),k($,null,P(e.transactions.data,i=>(p(),N(X,{transaction:i,key:i.id},null,8,["transaction"]))),128))])),h(Y,{links:e.transactions.links},null,8,["links"])]),_:1}))}};export{Be as default};