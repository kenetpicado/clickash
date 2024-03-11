import{o as r,c as l,b as s,f as c,k as p,B as x,n as m,u as o,i as d,t as g,e as y,Z as _,d as a,g as b,p as i,F as v,l as w}from"./app-c30d065f.js";import{c as u,I as k,a as I}from"./IconUser-29de581c.js";var M=u("currency-dollar","IconCurrencyDollar",[["path",{d:"M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2",key:"svg-0"}],["path",{d:"M12 3v3m0 12v3",key:"svg-1"}]]),C=u("home","IconHome",[["path",{d:"M5 12l-2 0l9 -9l9 9l-2 0",key:"svg-0"}],["path",{d:"M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7",key:"svg-1"}],["path",{d:"M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6",key:"svg-2"}]]),$=u("users-group","IconUsersGroup",[["path",{d:"M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-0"}],["path",{d:"M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1",key:"svg-1"}],["path",{d:"M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-2"}],["path",{d:"M17 10h2a2 2 0 0 1 2 2v1",key:"svg-3"}],["path",{d:"M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-4"}],["path",{d:"M3 13v-1a2 2 0 0 1 2 -2h2",key:"svg-5"}]]);const j={class:"flex items-center justify-center flex-col"},B={key:0,class:"text-xxs text-gray-600 lg:text-sm"},N={__name:"NavItem",props:{item:{type:Object,required:!0},active:{type:Boolean,default:!1}},setup(e){return(f,h)=>(r(),l("div",j,[s(o(d),{href:e.item.route,class:m(["inline-flex items-center justify-center w-9 h-9 font-medium rounded-full group",e.active?"bg-primary":"bg-transparent"])},{default:c(()=>[(r(),p(x(e.item.icon),{class:m(e.active?"w-4 h-4 text-white":"w-5 h-5 text-gray-600")},null,8,["class"]))]),_:1},8,["href","class"]),e.item.title?(r(),l("span",B,g(e.item.title),1)):y("",!0)]))}},V={class:"bg-white mb-3 shadow-lg"},D={class:"flex items-center justify-between px-4 py-2 mx-auto max-w-screen-lg"},U=a("img",{src:"/profile.png",class:"w-10 h-10 object-cover rounded-full",alt:""},null,-1),G={class:"p-4 mx-auto max-w-screen-lg mb-12"},R={class:"flex items-center overflow-x-auto hide-scrollbar"},S={class:"flex items-center justify-between mb-4 text-gray-600"},z={class:"fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 border-2 border-gray-100 bg-card rounded-xl bottom-2 left-1/2"},A={class:"grid h-full max-w-lg grid-cols-5 mx-auto"},q={__name:"ClientareaLayout",props:{title:{type:String,default:""},breads:{type:Array,default:[]}},setup(e){const f=[{icon:$,route:route("clientarea.sellers.index"),title:"Usuarios"},{icon:M,route:route("clientarea.invoices.index"),title:"Recibos"},{icon:C,route:route("clientarea.raffles.index"),title:"Rifas"},{icon:k,route:route("clientarea.results.index"),title:"Resultados"},{icon:I,route:route("clientarea.profile.index"),title:"Perfil"}],h=t=>window.location.href.includes(t);return(t,F)=>(r(),l(v,null,[s(o(_),{title:e.title},null,8,["title"]),a("nav",V,[a("div",D,[s(o(d),{href:t.route("clientarea.raffles.index"),class:"font-bold text-lg text-gray-600"},{default:c(()=>[b(g(t.$page.props.app_name),1)]),_:1},8,["href"]),s(o(d),{href:t.route("clientarea.profile.index"),class:"font-bold text-lg text-gray-600"},{default:c(()=>[U]),_:1},8,["href"])])]),a("main",G,[a("div",R,[i(t.$slots,"options")]),a("div",S,[i(t.$slots,"header")]),i(t.$slots,"default")]),a("div",z,[a("div",A,[(r(),l(v,null,w(f,n=>s(N,{key:n.route,item:n,active:h(n.route)},null,8,["item","active"])),64))])])],64))}};export{M as I,q as _};
