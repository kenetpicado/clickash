import{_ as u}from"./AppLayout-794b63ff.js";import{_ as c}from"./JsonContent-7384591a.js";import{o as t,j as a,e as o,b as s,t as i,c as d,k as m,F as f}from"./app-c522cbdb.js";import"./IconUsers-3abb8704.js";import"./IconUser-2e22d4e3.js";const b={class:"title"},p={class:"grid grid-cols-1 lg:grid-cols-4 gap-4"},v={__name:"Availability",props:{user:{type:Object,required:!0},raffle:{type:Object,required:!0},availability:{type:Object,required:!0}},setup(e){const n=e,l=[{name:"Inicio",route:route("dashboard.index")},{name:"Usuarios",route:route("dashboard.users.index")},{name:"Rifas",route:route("dashboard.users.show",n.user.id)},{name:"Horario",route:window.location.href}];return(_,h)=>(t(),a(u,{title:"Horario",breads:l},{header:o(()=>[s("span",b,' Horario de: "'+i(e.raffle.name)+'" del usuario '+i(e.user.name),1)]),default:o(()=>[s("div",p,[(t(!0),d(f,null,m(e.availability,r=>(t(),a(c,{title:r.day,content:r},null,8,["title","content"]))),256))])]),_:1}))}};export{v as default};