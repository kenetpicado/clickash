import{t as y}from"./toast-46677e62.js";import{r as b,T as V,j as C,o,c as r,d as n,F as h,l as $,t as d,b as i,f as g,u as s,e as p,k as w}from"./app-3eeff63f.js";import{_ as u,b as I,a as U}from"./DropdownItem-86acfc7a.js";import{_ as v}from"./Checkbox-8ecfdaf2.js";import{_ as c}from"./InputForm-78d66890.js";import{_ as S}from"./FormModal-a2d43557.js";import{I as q,a as L,b as R}from"./IconReportAnalytics-30957bf5.js";import{c as j}from"./createVueComponent-06cc832b.js";import{I as D}from"./IconDeviceWatch-8943fcc6.js";import{_ as M}from"./ClientareaLayout-e660f941.js";import"./Modal-3a363d64.js";import"./IconUser-1b332bbc.js";var N=j("user-check","IconUserCheck",[["path",{d:"M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0",key:"svg-0"}],["path",{d:"M6 21v-2a4 4 0 0 1 4 -4h4",key:"svg-1"}],["path",{d:"M15 19l2 2l4 -4",key:"svg-2"}]]);const O={class:"grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"},B={class:"bg-gray-100 rounded-lg p-2 w-full"},F={class:"flex justify-between"},A={class:"px-1 py-1"},E={class:"px-1 py-1"},T={class:"flex items-center gap-2 mb-3"},X={class:"rounded-lg w-20 h-20 overflow-hidden"},z=["src"],G={key:1,src:"/games.png",alt:"",class:"w-full h-full"},H={class:"flex flex-col gap-1 text-xs"},W={key:0},J={key:1},K={key:2},P={class:"grid grid-cols-2 gap-4"},Q={class:"grid grid-cols-2 gap-4 mb-1"},Y={key:0,class:"grid grid-cols-2 gap-4"},Z={__name:"RaffleTab",props:{raffles:{type:Object,required:!0}},setup(_){const m=b(!1),t=V({raffle_name:null,raffle_id:null,settings:{super_x:!0,date:!1,min:null,max:null,general_limit:null,individual_limit:null,multiplier:70}});function x(a){t.raffle_name=a.name,t.raffle_id=a.id,Object.assign(t.settings,a.settings),m.value=!0}function k(){t.put(route("clientarea.raffles.update",t.raffle_id),{preserveScroll:!0,onSuccess:()=>{f(),y.success("Rifa actualizada")}})}const f=()=>{t.reset(),m.value=!1};return C(()=>t.settings.date,a=>{a&&(t.settings.min=null,t.settings.max=null)}),(a,l)=>(o(),r(h,null,[n("div",O,[(o(!0),r(h,null,$(_.raffles,e=>(o(),r("div",B,[n("div",F,[n("span",null,d(e.name),1),i(U,null,{default:g(()=>[n("div",A,[i(u,{href:a.route("clientarea.raffles.show",e.id),title:"Ventas",icon:s(q)},null,8,["href","icon"]),i(u,{href:a.route("clientarea.raffles.winning-numbers.index",e.id),title:"Ganadores",icon:s(N)},null,8,["href","icon"]),i(u,{href:a.route("clientarea.raffles.reports",e.id),title:"Reportes",icon:s(L)},null,8,["href","icon"])]),n("div",E,[i(u,{href:a.route("clientarea.raffles.blocked-numbers.index",e.id),title:"Dígitos bloqueados",icon:s(R)},null,8,["href","icon"]),i(u,{href:a.route("clientarea.raffles.availability.index",e.id),title:"Horario",icon:s(D)},null,8,["href","icon"]),i(u,{onClick:te=>x(e),title:"Configuración",icon:s(I)},null,8,["onClick","icon"])])]),_:2},1024)]),n("div",T,[n("div",X,[e.image?(o(),r("img",{key:0,src:e.image,alt:"",class:"w-full h-full"},null,8,z)):(o(),r("img",G))]),n("div",H,[n("span",null,"Super X: "+d(e.settings.super_x?"Activado":"Desactivado"),1),e.settings.general_limit?(o(),r("span",W," Limite general: C$"+d(e.settings.general_limit),1)):p("",!0),e.settings.individual_limit?(o(),r("span",J," Limite individual: C$"+d(e.settings.individual_limit),1)):p("",!0),e.settings.date?p("",!0):(o(),r("span",K,d(e.settings.min)+" - "+d(e.settings.max),1))])])]))),256))]),i(S,{show:m.value,title:s(t).raffle_name,onOnCancel:f,onOnSubmit:k},{default:g(()=>[n("div",P,[i(c,{text:"Limite general C$",modelValue:s(t).settings.general_limit,"onUpdate:modelValue":l[0]||(l[0]=e=>s(t).settings.general_limit=e),type:"number"},null,8,["modelValue"]),i(c,{text:"Limite indiv. C$",modelValue:s(t).settings.individual_limit,"onUpdate:modelValue":l[1]||(l[1]=e=>s(t).settings.individual_limit=e),type:"number"},null,8,["modelValue"])]),n("div",Q,[i(v,{checked:s(t).settings.super_x,"onUpdate:checked":l[2]||(l[2]=e=>s(t).settings.super_x=e),text:"Super X"},null,8,["checked"]),i(v,{checked:s(t).settings.date,"onUpdate:checked":l[3]||(l[3]=e=>s(t).settings.date=e),text:"Fecha"},null,8,["checked"])]),s(t).settings.date?p("",!0):(o(),r("div",Y,[i(c,{text:"Número inicio",modelValue:s(t).settings.min,"onUpdate:modelValue":l[4]||(l[4]=e=>s(t).settings.min=e),required:"",type:"number"},null,8,["modelValue"]),i(c,{text:"Número final",modelValue:s(t).settings.max,"onUpdate:modelValue":l[5]||(l[5]=e=>s(t).settings.max=e),required:"",type:"number"},null,8,["modelValue"])])),i(c,{text:"Multiplicador",modelValue:s(t).settings.multiplier,"onUpdate:modelValue":l[6]||(l[6]=e=>s(t).settings.multiplier=e),type:"number",required:""},null,8,["modelValue"])]),_:1},8,["show","title"])],64))}},ee=n("span",{class:"title"}," Rifas ",-1),ge={__name:"Index",props:{raffles:{type:Object,required:!0}},setup(_){return(m,t)=>(o(),w(M,{title:"Rifas"},{header:g(()=>[ee]),default:g(()=>[i(Z,{raffles:_.raffles},null,8,["raffles"])]),_:1}))}};export{ge as default};
