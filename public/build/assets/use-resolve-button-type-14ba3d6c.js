import{K as A,x as $,F as k,r as P,q as S,E as T}from"./app-ff81f535.js";function v(e,t,...n){if(e in t){let o=t[e];return typeof o=="function"?o(...n):o}let r=new Error(`Tried to handle "${e}" but there is no handler defined. Only defined handlers are: ${Object.keys(t).map(o=>`"${o}"`).join(", ")}.`);throw Error.captureStackTrace&&Error.captureStackTrace(r,v),r}var H=(e=>(e[e.None=0]="None",e[e.RenderStrategy=1]="RenderStrategy",e[e.Static=2]="Static",e))(H||{}),D=(e=>(e[e.Unmount=0]="Unmount",e[e.Hidden=1]="Hidden",e))(D||{});function M({visible:e=!0,features:t=0,ourProps:n,theirProps:r,...o}){var i;let u=O(r,n),s=Object.assign(o,{props:u});if(e||t&2&&u.static)return y(s);if(t&1){let p=(i=u.unmount)==null||i?0:1;return v(p,{0(){return null},1(){return y({...o,props:{...u,hidden:!0,style:{display:"none"}}})}})}return y(s)}function y({props:e,attrs:t,slots:n,slot:r,name:o}){var i,u;let{as:s,...p}=U(e,["unmount","static"]),l=(i=n.default)==null?void 0:i.call(n,r),m={};if(r){let c=!1,h=[];for(let[d,f]of Object.entries(r))typeof f=="boolean"&&(c=!0),f===!0&&h.push(d);c&&(m["data-headlessui-state"]=h.join(" "))}if(s==="template"){if(l=j(l??[]),Object.keys(p).length>0||Object.keys(t).length>0){let[c,...h]=l??[];if(!R(c)||h.length>0)throw new Error(['Passing props on "template"!',"",`The current component <${o} /> is rendering a "template".`,"However we need to passthrough the following props:",Object.keys(p).concat(Object.keys(t)).map(a=>a.trim()).filter((a,b,E)=>E.indexOf(a)===b).sort((a,b)=>a.localeCompare(b)).map(a=>`  - ${a}`).join(`
`),"","You can apply a few solutions:",['Add an `as="..."` prop, to ensure that we render an actual element instead of a "template".',"Render a single element as the child so that we can forward the props onto that element."].map(a=>`  - ${a}`).join(`
`)].join(`
`));let d=O((u=c.props)!=null?u:{},p),f=A(c,d);for(let a in d)a.startsWith("on")&&(f.props||(f.props={}),f.props[a]=d[a]);return f}return Array.isArray(l)&&l.length===1?l[0]:l}return $(s,Object.assign({},p,m),{default:()=>l})}function j(e){return e.flatMap(t=>t.type===k?j(t.children):[t])}function O(...e){if(e.length===0)return{};if(e.length===1)return e[0];let t={},n={};for(let r of e)for(let o in r)o.startsWith("on")&&typeof r[o]=="function"?(n[o]!=null||(n[o]=[]),n[o].push(r[o])):t[o]=r[o];if(t.disabled||t["aria-disabled"])return Object.assign(t,Object.fromEntries(Object.keys(n).map(r=>[r,void 0])));for(let r in n)Object.assign(t,{[r](o,...i){let u=n[r];for(let s of u){if(o instanceof Event&&o.defaultPrevented)return;s(o,...i)}}});return t}function C(e){let t=Object.assign({},e);for(let n in t)t[n]===void 0&&delete t[n];return t}function U(e,t=[]){let n=Object.assign({},e);for(let r of t)r in n&&delete n[r];return n}function R(e){return e==null?!1:typeof e.type=="string"||typeof e.type=="object"||typeof e.type=="function"}let L=0;function N(){return++L}function F(){return N()}var x=(e=>(e.Space=" ",e.Enter="Enter",e.Escape="Escape",e.Backspace="Backspace",e.Delete="Delete",e.ArrowLeft="ArrowLeft",e.ArrowUp="ArrowUp",e.ArrowRight="ArrowRight",e.ArrowDown="ArrowDown",e.Home="Home",e.End="End",e.PageUp="PageUp",e.PageDown="PageDown",e.Tab="Tab",e))(x||{});function g(e){var t;return e==null||e.value==null?null:(t=e.value.$el)!=null?t:e.value}function w(e,t){if(e)return e;let n=t??"button";if(typeof n=="string"&&n.toLowerCase()==="button")return"button"}function K(e,t){let n=P(w(e.value.type,e.value.as));return S(()=>{n.value=w(e.value.type,e.value.as)}),T(()=>{var r;n.value||g(t)&&g(t)instanceof HTMLButtonElement&&!((r=g(t))!=null&&r.hasAttribute("type"))&&(n.value="button")}),n}export{M as H,C as K,H as N,U as T,x as a,K as b,g as o,F as t,v as u};