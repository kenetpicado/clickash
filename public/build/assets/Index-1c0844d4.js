import{t as y}from"./toast-9cf9c75e.js";import{r as b,T as V,j as w,o as a,c as r,d as l,F as h,l as C,t as d,b as i,f as g,u as s,e as p,k as $}from"./app-e27dafda.js";import{_ as u,I,a as U}from"./DropdownItem-84bd0762.js";import{_ as x}from"./Checkbox-28f94ccc.js";import{_ as c}from"./InputForm-90ce5600.js";import{_ as S}from"./FormModal-33a743fe.js";import{I as q,a as D,b as L}from"./IconReportAnalytics-40a94929.js";import{c as M}from"./IconUser-0812fc5e.js";import{I as R}from"./IconDeviceWatch-9eb0469f.js";import{_ as j}from"./ClientareaLayout-2fdc5cbb.js";import"./IconList-2f320794.js";import"./use-resolve-button-type-7f78c9d6.js";import"./Modal-9e846b64.js";var N=M("user-check","IconUserCheck",[["path",{d:"M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0",key:"svg-0"}],["path",{d:"M6 21v-2a4 4 0 0 1 4 -4h4",key:"svg-1"}],["path",{d:"M15 19l2 2l4 -4",key:"svg-2"}]]);const O={class:"grid grid-cols-1 lg:grid-cols-3 gap-4"},B={class:"bg-card rounded-xl p-2 w-full"},F={class:"flex justify-between text-gray-600"},A={class:"px-1 py-1"},E={class:"px-1 py-1"},T={class:"flex items-center gap-2 mb-3"},X={class:"bg-white rounded-xl w-20 h-20 overflow-hidden"},z=["src"],G={key:1,src:"/games.png",alt:"",class:"w-full h-full"},H={class:"flex flex-col gap-1 text-xs"},W={key:0},J={key:1},K={key:2},P={class:"w-full text-center bg-white py-1 rounded-xl text-primary text-xs"},Q={key:0},Y={key:1},Z={class:"grid grid-cols-2 gap-4"},ee={class:"grid grid-cols-2 gap-4 mb-1"},te={key:0,class:"grid grid-cols-2 gap-4"},se={__name:"RaffleTab",props:{raffles:{type:Object,required:!0}},setup(_){const m=b(!1),t=V({raffle_name:null,raffle_id:null,settings:{super_x:!0,date:!1,min:null,max:null,general_limit:null,individual_limit:null,multiplier:70}});function v(o){t.raffle_name=o.name,t.raffle_id=o.id,Object.assign(t.settings,o.settings),m.value=!0}function k(){t.put(route("clientarea.raffles.update",t.raffle_id),{preserveScroll:!0,onSuccess:()=>{f(),y.success("Rifa actualizada")}})}const f=()=>{t.reset(),m.value=!1};return w(()=>t.settings.date,o=>{o&&(t.settings.min=null,t.settings.max=null)}),(o,n)=>(a(),r(h,null,[l("div",O,[(a(!0),r(h,null,C(_.raffles,e=>(a(),r("div",B,[l("div",F,[l("span",null,d(e.name),1),i(U,null,{default:g(()=>[l("div",A,[i(u,{href:o.route("clientarea.raffles.show",e.id),title:"Ventas",icon:s(q)},null,8,["href","icon"]),i(u,{href:o.route("clientarea.raffles.winning-numbers.index",e.id),title:"Ganadores",icon:s(N)},null,8,["href","icon"]),i(u,{href:o.route("clientarea.raffles.reports",e.id),title:"Reportes",icon:s(D)},null,8,["href","icon"])]),l("div",E,[i(u,{href:o.route("clientarea.raffles.blocked-numbers.index",e.id),title:"Dígitos bloqueados",icon:s(L)},null,8,["href","icon"]),i(u,{href:o.route("clientarea.raffles.availability.index",e.id),title:"Horario",icon:s(R)},null,8,["href","icon"]),i(u,{onClick:ne=>v(e),title:"Configuración",icon:s(I)},null,8,["onClick","icon"])])]),_:2},1024)]),l("div",T,[l("div",X,[e.image?(a(),r("img",{key:0,src:e.image,alt:"",class:"w-full h-full"},null,8,z)):(a(),r("img",G))]),l("div",H,[l("span",null,"Super X: "+d(e.settings.super_x?"Activado":"Desactivado"),1),e.settings.general_limit?(a(),r("span",W," Limite general: C$"+d(e.settings.general_limit),1)):p("",!0),e.settings.individual_limit?(a(),r("span",J," Limite individual: C$"+d(e.settings.individual_limit),1)):p("",!0),e.settings.multiplier?(a(),r("span",K," Multiplicador: "+d(e.settings.multiplier),1)):p("",!0)])]),l("div",P,[e.settings.date?(a(),r("span",Q," Fecha ")):(a(),r("span",Y," Desde "+d(e.settings.min)+" hasta "+d(e.settings.max),1))])]))),256))]),i(S,{show:m.value,title:s(t).raffle_name,onOnCancel:f,onOnSubmit:k},{default:g(()=>[l("div",Z,[i(c,{text:"Limite general C$",modelValue:s(t).settings.general_limit,"onUpdate:modelValue":n[0]||(n[0]=e=>s(t).settings.general_limit=e),type:"number"},null,8,["modelValue"]),i(c,{text:"Limite indiv. C$",modelValue:s(t).settings.individual_limit,"onUpdate:modelValue":n[1]||(n[1]=e=>s(t).settings.individual_limit=e),type:"number"},null,8,["modelValue"])]),l("div",ee,[i(x,{checked:s(t).settings.super_x,"onUpdate:checked":n[2]||(n[2]=e=>s(t).settings.super_x=e),text:"Super X"},null,8,["checked"]),i(x,{checked:s(t).settings.date,"onUpdate:checked":n[3]||(n[3]=e=>s(t).settings.date=e),text:"Fecha"},null,8,["checked"])]),s(t).settings.date?p("",!0):(a(),r("div",te,[i(c,{text:"Número inicio",modelValue:s(t).settings.min,"onUpdate:modelValue":n[4]||(n[4]=e=>s(t).settings.min=e),required:"",type:"number"},null,8,["modelValue"]),i(c,{text:"Número final",modelValue:s(t).settings.max,"onUpdate:modelValue":n[5]||(n[5]=e=>s(t).settings.max=e),required:"",type:"number"},null,8,["modelValue"])])),i(c,{text:"Multiplicador",modelValue:s(t).settings.multiplier,"onUpdate:modelValue":n[6]||(n[6]=e=>s(t).settings.multiplier=e),type:"number",required:""},null,8,["modelValue"])]),_:1},8,["show","title"])],64))}},ie=l("span",{class:"title"}," Rifas ",-1),xe={__name:"Index",props:{raffles:{type:Object,required:!0}},setup(_){return(m,t)=>(a(),$(j,{title:"Rifas"},{header:g(()=>[ie]),default:g(()=>[i(se,{raffles:_.raffles},null,8,["raffles"])]),_:1}))}};export{xe as default};
