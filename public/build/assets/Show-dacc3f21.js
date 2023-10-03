import{T as x}from"./TableSection-80d82f57.js";import{_ as $}from"./AppLayout-028e59c2.js";import{I,c as R}from"./helpers-1e720f9b.js";import{t as S}from"./toast-53144f94.js";import{r as p,o as s,e as f,f as a,b as e,t as l,d as i,n as w,c as o,h as b,F as g,a as y,O as C,u as q}from"./app-5962aa57.js";import{_ as A}from"./AddButton-0bd50f98.js";import{_ as B}from"./FormModal-6aeb2ebe.js";import{_ as D}from"./SelectForm-576ebef0.js";import"./_plugin-vue_export-helper-c27b6911.js";const T={class:"title"},E={class:"flex flex-wrap text-sm font-medium text-center text-gray-500 mb-4"},F={class:"mr-2"},Q={class:"mr-2"},U=e("th",null,"ID",-1),H=e("th",null,"Nombre",-1),J=e("th",null,"Email",-1),P=e("th",null,"Active",-1),z=e("th",null,"Status",-1),G={class:"hover:bg-gray-50"},L={key:0,class:"badge-green"},M={key:1},K={class:"uppercase"},W={key:0},X=e("td",{colspan:"4",class:"text-center"},"No data to display",-1),Y=[X],Z=e("th",null,"ID",-1),ee=e("th",null,"Imagen",-1),te=e("th",null,"Nombre",-1),se=e("th",null,"Settings",-1),le=e("th",null,"Acciones",-1),oe={class:"hover:bg-gray-50"},ne=["src"],ae={class:"font-bold"},re={key:0},ue=e("td",{colspan:"5",class:"text-center"},"No data to display",-1),de=[ue],ie=e("option",{selected:"",disabled:"",value:""},"Select Raffle",-1),ce=["value"],xe={__name:"Show",props:{user:{type:Object,required:!0},sellers:{type:Object,required:!0},raffles:{type:Object,required:!0},all_raffles:{type:Object,required:!0}},setup(r){const c=r,j=[{name:"Home",route:route("dashboard.users.index")},{name:"Users",route:route("dashboard.users.index")},{name:c.user.name,route:route("dashboard.users.show",c.user.id)}],d=p("sellers"),m=p(!1),_=p(null);function v(u){return d.value==u?"inline-block px-4 py-2 text-white bg-gray-800 rounded-lg":"inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-100"}function N(u){return u||"https://media.istockphoto.com/id/1211282980/es/vector/ganadores-afortunados-girando-tambor-de-la-rifa.jpg?s=612x612&w=0&k=20&c=1jJPxjaVHqPFA_DQGDV3QEBQ6_C3pbhjs8Ies2kR-44="}function O(u){R({message:"Are you sure you want to delete this raffle?",onConfirm:()=>{C.delete(route("dashboard.users.raffles.destroy",[c.user.id,u]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{S.success("Raffle deleted successfully")}})}})}function k(){_.value=null,m.value=!1}function V(){C.post(route("dashboard.users.raffles.store",c.user.id),{raffle_id:_.value},{onSuccess:()=>{S.success("Raffle added successfully"),k()}})}return(u,n)=>(s(),f($,{title:"Users",breads:j},{header:a(()=>[e("span",T,l(r.user.name),1),d.value=="raffles"?(s(),f(A,{key:0,onClick:n[0]||(n[0]=t=>m.value=!0)})):i("",!0)]),default:a(()=>[e("ul",E,[e("li",F,[e("span",{role:"button",onClick:n[1]||(n[1]=t=>d.value="sellers"),class:w(v("sellers"))}," Sellers ",2)]),e("li",Q,[e("span",{role:"button",onClick:n[2]||(n[2]=t=>d.value="raffles"),class:w(v("raffles"))}," Raffles ",2)])]),d.value=="sellers"?(s(),f(x,{key:0},{header:a(()=>[U,H,J,P,z]),body:a(()=>[(s(!0),o(g,null,b(r.sellers,(t,h)=>(s(),o("tr",G,[e("td",null,l(h+1),1),e("td",null,l(t.name),1),e("td",null,l(t.email),1),e("td",null,[t.online=="Now"?(s(),o("span",L,l(t.online),1)):(s(),o("span",M,l(t.online),1))]),e("td",null,[e("span",K,l(t.status),1)])]))),256)),r.sellers.length==0?(s(),o("tr",W,Y)):i("",!0)]),_:1})):i("",!0),d.value=="raffles"?(s(),f(x,{key:1},{header:a(()=>[Z,ee,te,se,le]),body:a(()=>[(s(!0),o(g,null,b(r.raffles,(t,h)=>(s(),o("tr",oe,[e("td",null,l(h+1),1),e("td",null,[e("img",{src:N(t.image),alt:"",class:"w-20 h-20 object-cover rounded-lg"},null,8,ne)]),e("td",null,[e("span",ae,l(t.name),1)]),e("td",null,[e("pre",null,l(JSON.parse(t.pivot.settings)),1)]),e("td",null,[y(q(I),{role:"button",onClick:_e=>O(t.id)},null,8,["onClick"])])]))),256)),r.raffles.length==0?(s(),o("tr",re,de)):i("",!0)]),_:1})):i("",!0),y(B,{show:m.value,title:"Raffles",onOnCancel:k,onOnSubmit:V},{default:a(()=>[y(D,{text:"Raffle",modelValue:_.value,"onUpdate:modelValue":n[3]||(n[3]=t=>_.value=t),required:""},{default:a(()=>[ie,(s(!0),o(g,null,b(r.all_raffles,t=>(s(),o("option",{value:t.id},l(t.name),9,ce))),256))]),_:1},8,["modelValue"])]),_:1},8,["show"])]),_:1}))}};export{xe as default};
