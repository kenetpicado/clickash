var y=Object.defineProperty;var k=(n,t,e)=>t in n?y(n,t,{enumerable:!0,configurable:!0,writable:!0,value:e}):n[t]=e;var g=(n,t,e)=>(k(n,typeof t!="symbol"?t+"":t,e),e);import{k as p,o as l,c,b,a as v,u as M,d as f,F as D,h as T,n as w,t as x,O as C}from"./app-5962aa57.js";import{c as F,I as $}from"./AppLayout-028e59c2.js";var N=F("chevron-left","IconChevronLeft",[["path",{d:"M15 6l-6 6l6 6",key:"svg-0"}]]);const S={key:0,class:"w-full py-2 px-4 mb-4"},I={class:"flex justify-end items-center gap-2"},Y=["onClick"],_={__name:"ThePaginator",props:{links:{type:Object,required:!1}},setup(n){const t=n,e=p(()=>t.links[0].url),r=p(()=>t.links[t.links.length-1].url),o=p(()=>t.links.slice(1,t.links.length-1));function s(a){C.get(a,{},{preserveState:!0,preserveScroll:!0})}return(a,h)=>n.links&&o.value.length>1?(l(),c("div",S,[b("div",I,[e.value?(l(),c("span",{key:0,onClick:h[0]||(h[0]=i=>s(e.value)),class:"px-3 hover:bg-gray-100 rounded-md",role:"button"},[v(M(N))])):f("",!0),(l(!0),c(D,null,T(o.value,i=>(l(),c("span",{onClick:A=>s(i.url),class:w(["px-3 rounded-md",{"bg-indigo-600 text-white":i.active,"hover:bg-indigo-50":!i.active}]),role:"button"},x(i.label),11,Y))),256)),r.value?(l(),c("button",{key:1,onClick:h[1]||(h[1]=i=>s(r.value)),class:"px-3 hover:bg-gray-100 rounded-md",type:"button"},[v(M($))])):f("",!0)])])):f("",!0)}},u={year:31536e3,month:2592e3,day:86400,hour:3600,minute:60,second:1};class m{constructor(t){g(this,"date");t&&!t.includes(":")&&(t=t+"T06:00:00.000000Z"),t?this.date=new Date(t):this.date=new Date}static create(t){return new m(t)}static today(t="Y-m-d"){return new m().format(t)}static now(){return new m}monthName(){return["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"][this.date.getMonth()]}month(){return this.date.getMonth()+1}addMonth(t=1){return this.date.setMonth(this.date.getMonth()+t),this}addDays(t=1){return this.date.setDate(this.date.getDate()+t),this}addPeriod(t){return t==30?this.addMonth():this.addDays(t),this}setTime(t){const[e,r,o]=t.split(":");return this.date.setHours(e),this.date.setMinutes(r),this.date.setSeconds(o),this}getTimeFormat(){const t=this.date.getHours(),r=this.date.getMinutes().toString().padStart(2,"0");return t>=12?t>12?`${t-12}:${r} PM`:`${t}:${r} PM`:`${t}:${r} AM`}format(t="Y-m-d"){const e=d(this.date.getMonth()+1);return t.replace("Y",this.date.getFullYear()).replace("m",e).replace("d",d(this.date.getDate())).replace("H",d(this.date.getHours())).replace("i",d(this.date.getMinutes())).replace("s",d(this.date.getSeconds())).replace("F",this.monthName())}static simpleFormat(t,e="d/m/Y"){const[r,o,s]=t.split("-");return e.replace("Y",r).replace("m",o).replace("d",s).toString()}diffForHumans(){const t=Math.floor(Date.now()/1e3),e=Math.floor(this.date.getTime()/1e3),r=t-e,o=new Intl.RelativeTimeFormat(navigator.language,{numeric:"auto"});if(r>0){for(const s in u)if(r>=u[s]){const a=Math.floor(r/u[s]);return o.format(-a,s)}}else for(const s in u)if(r<=-u[s]){const a=Math.floor(r/u[s]);return o.format(-a,s)}return"Ahora"}}function d(n){return n.toString().padStart(2,"0")}export{m as C,_};