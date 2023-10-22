import{_ as C}from"./AddButton-fbdd42be.js";import{_ as D}from"./AppLayout-f344d739.js";import R from"./Availability-e7f9d26f.js";import F from"./BlockedNumber-865814c4.js";import L from"./Transaction-9e7e63d5.js";import U from"./WinningNumber-fc664022.js";import{_ as $}from"./StatCard-73840e5a.js";import{C as S}from"./Carbon-e7b34390.js";import{_ as H}from"./SelectForm-77f77540.js";import P from"./DailySalesResume-94b3cc39.js";import{r as v,g as j,j as h,o as r,e as i,f as w,b as s,t as T,d as u,n as m,c as n,F as c,h as M,a as f,u as V,O as z}from"./app-5c7a9679.js";import{I as O}from"./IconCurrencyDollar-b96fdf9b.js";import{c as E}from"./createVueComponent-44e96f3b.js";import"./IconChevronRight-92c3d40e.js";import"./TableSection-56a9fd9b.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./FormModal-ff07fe4a.js";import"./InputForm-69a3ad5e.js";import"./helpers-a5216626.js";import"./toast-633378cc.js";import"./IconEdit-3491c789.js";import"./IconTrash-a682585e.js";import"./ThePaginator-3177a50b.js";var A=E("currency-dollar-off","IconCurrencyDollarOff",[["path",{d:"M16.7 8a3 3 0 0 0 -2.7 -2h-4m-2.557 1.431a3 3 0 0 0 2.557 4.569h2m4.564 4.558a3 3 0 0 1 -2.564 1.442h-4a3 3 0 0 1 -2.7 -2",key:"svg-0"}],["path",{d:"M12 3v3m0 12v3",key:"svg-1"}],["path",{d:"M3 3l18 18",key:"svg-2"}]]);const G={class:"title"},J={class:"flex gap-3 overflow-x-auto hide-scrollbar mb-4"},K={class:"grid grid-cols-4 gap-4 mb-4"},Q={class:"grid grid-cols-4 gap-4 mb-4"},W={class:"grid grid-cols-4 gap-4"},X={key:0,value:"",selected:""},Y={key:1,value:"",disabled:"",selected:""},Z=["value"],ee={class:"grid grid-cols-4 gap-4"},Me={__name:"Show",props:{raffle:{type:Object,required:!0},transactions:{type:Object,required:!0},blockeds:{type:Object,required:!0},availability:{type:Object,required:!0},results:{type:Object,required:!0},winners:{type:Object,required:!0},settings:{type:Object,required:!0},daily_transactions:{type:Number,required:!0},daily_sales_resume:{type:Object,required:!0}},setup(l){const d=l,x=[{name:"Inicio",route:route("clientarea.index")},{name:"Rifas",route:route("clientarea.raffles.index")},{name:d.raffle.name,route:route("clientarea.raffles.show",d.raffle.id)}],a=v(localStorage.getItem("currentTab")||0),b=v(!1),y=v(!1),g=v(!1),p=v(null);j(a,o=>{localStorage.setItem("currentTab",o)});const _=d.availability.filter(o=>o.order==new Date().getDay()),k=h(()=>_.length==0?[]:_[0].blocked_hours),I=h(()=>[{title:"Ventas del dia",value:"C$"+d.daily_transactions.toLocaleString(),icon:O},{title:"Premios del dia",value:"C$"+d.winners.reduce((o,e)=>o+parseFloat(e.prize),0).toLocaleString(),icon:A}]),N=h(()=>d.results.map(o=>({title:S.create().setTime(o.hour).getTimeFormat(),value:o.number,icon:O})));j(()=>p.value,o=>{z.get(route("clientarea.raffles.show",d.raffle.id),{hour:o},{preserveState:!0,preserveScroll:!0,only:["daily_sales_resume"]})});const q=new URLSearchParams(window.location.search);return q.get("hour")&&(p.value=q.get("hour")),(o,e)=>(r(),i(D,{title:"Rifa",breads:x},{header:w(()=>[s("span",G,T(l.raffle.name),1),a.value==1?(r(),i(C,{key:0,onClick:e[0]||(e[0]=t=>b.value=!0)})):u("",!0),a.value==2?(r(),i(C,{key:1,onClick:e[1]||(e[1]=t=>y.value=!0)})):u("",!0),a.value==3?(r(),i(C,{key:2,onClick:e[2]||(e[2]=t=>g.value=!0)})):u("",!0)]),default:w(()=>[s("div",J,[s("div",{class:m(a.value==0?"active-tab":"inactive-tab"),onClick:e[3]||(e[3]=t=>a.value=0),role:"button"}," Ventas ",2),s("div",{class:m(a.value==1?"active-tab":"inactive-tab"),onClick:e[4]||(e[4]=t=>a.value=1),role:"button"}," Bloqueados ",2),s("div",{class:m(a.value==2?"active-tab":"inactive-tab"),onClick:e[5]||(e[5]=t=>a.value=2),role:"button"}," Horario ",2),s("div",{class:m(a.value==3?"active-tab":"inactive-tab"),onClick:e[6]||(e[6]=t=>a.value=3),role:"button"}," Resultados ",2),s("div",{class:m(a.value==4?"active-tab":"inactive-tab"),onClick:e[7]||(e[7]=t=>a.value=4),role:"button"}," Reporte de ventas ",2)]),a.value==0?(r(),n(c,{key:0},[s("div",K,[(r(!0),n(c,null,M(I.value,t=>(r(),i($,{stat:t,key:t.title},null,8,["stat"]))),128))]),f(L,{transactions:l.transactions},null,8,["transactions"])],64)):u("",!0),a.value==1?(r(),i(F,{key:1,blockeds:l.blockeds,raffle:l.raffle,openModal:b.value,"onUpdate:openModal":e[8]||(e[8]=t=>b.value=t)},null,8,["blockeds","raffle","openModal"])):u("",!0),a.value==2?(r(),i(R,{key:2,availability:l.availability,raffle:l.raffle,openModal:y.value,"onUpdate:openModal":e[9]||(e[9]=t=>y.value=t)},null,8,["availability","raffle","openModal"])):u("",!0),a.value==3?(r(),n(c,{key:3},[s("div",Q,[(r(!0),n(c,null,M(N.value,t=>(r(),i($,{stat:t,key:t.title},null,8,["stat"]))),128))]),f(U,{results:l.results,raffle:l.raffle,openModal:g.value,"onUpdate:openModal":e[10]||(e[10]=t=>g.value=t),hours:k.value,winners:l.winners,settings:l.settings},null,8,["results","raffle","openModal","hours","winners","settings"])],64)):u("",!0),a.value==4?(r(),n(c,{key:4},[s("div",W,[f(H,{modelValue:p.value,"onUpdate:modelValue":e[11]||(e[11]=t=>p.value=t),text:"Turno",required:""},{default:w(()=>[k.value.length>0?(r(),n("option",X,"Ninguno")):(r(),n("option",Y,"No hay dias disponibles")),(r(!0),n(c,null,M(k.value,t=>(r(),n("option",{value:t},T(V(S).create().setTime(t).getTimeFormat()),9,Z))),256))]),_:1},8,["modelValue"])]),s("div",ee,[f($,{stat:{title:"Total",value:"C$"+l.daily_sales_resume.reduce((t,B)=>t+B.total,0).toLocaleString(),icon:V(O)}},null,8,["stat"])]),f(P,{sales:l.daily_sales_resume},null,8,["sales"])],64)):u("",!0)]),_:1}))}};export{Me as default};
