import{o,c as n,b as r,f as c,k as b,q as k,n as v,u as l,i as u,t as g,e as _,Z as w,d as a,g as I,p as i,F as p,l as M}from"./app-122945be.js";import{c as d,I as $,a as C}from"./IconUser-ab1b88a0.js";var j=d("currency-dollar","IconCurrencyDollar",[["path",{d:"M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2",key:"svg-0"}],["path",{d:"M12 3v3m0 12v3",key:"svg-1"}]]),B=d("home","IconHome",[["path",{d:"M5 12l-2 0l9 -9l9 9l-2 0",key:"svg-0"}],["path",{d:"M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7",key:"svg-1"}],["path",{d:"M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6",key:"svg-2"}]]),N=d("users-group","IconUsersGroup",[["path",{d:"M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-0"}],["path",{d:"M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1",key:"svg-1"}],["path",{d:"M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-2"}],["path",{d:"M17 10h2a2 2 0 0 1 2 2v1",key:"svg-3"}],["path",{d:"M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-4"}],["path",{d:"M3 13v-1a2 2 0 0 1 2 -2h2",key:"svg-5"}]]);const U={class:"flex items-center justify-center flex-col"},V={key:0,class:"text-xxs lg:text-sm"},A={__name:"NavItem",props:{item:{type:Object,required:!0},active:{type:Boolean,default:!1}},setup(t){return(f,h)=>(o(),n("div",U,[r(l(u),{href:t.item.route,class:v(["inline-flex items-center justify-center w-9 h-9 font-medium rounded-full group",t.active?"bg-green-pea-700":"bg-transparent"])},{default:c(()=>[(o(),b(k(t.item.icon),{class:v(t.active?"w-4 h-4 text-white":"w-5 h-5")},null,8,["class"]))]),_:1},8,["href","class"]),t.item.title?(o(),n("span",V,g(t.item.title),1)):_("",!0)]))}},D={class:"bg-white mb-3 shadow"},z={class:"flex items-center justify-between px-4 py-2 mx-auto max-w-screen-lg"},G=["src"],R={class:"p-4 mx-auto max-w-screen-lg mb-12"},S={class:"flex items-center overflow-x-auto hide-scrollbar"},q={class:"flex items-center justify-between mb-4"},F={class:"fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 bg-gray-100 border-2 rounded-lg bottom-2 left-1/2"},H={class:"grid h-full max-w-lg grid-cols-5 mx-auto"},O={__name:"ClientareaLayout",props:{title:{type:String,default:""},breads:{type:Array,default:[]}},setup(t){function f(e){return`https://ui-avatars.com/api/?name=${e}&size=256&background=2A6049&color=fff`}const h=[{icon:N,route:route("clientarea.sellers.index"),title:"Usuarios"},{icon:j,route:route("clientarea.invoices.index"),title:"Recibos"},{icon:B,route:route("clientarea.raffles.index"),title:"Rifas"},{icon:$,route:route("clientarea.results.index"),title:"Resultados"},{icon:C,route:route("clientarea.profile.index"),title:"Perfil"}],y=e=>window.location.href.includes(e);return(e,x)=>(o(),n(p,null,[r(l(w),{title:t.title},null,8,["title"]),a("nav",D,[a("div",z,[r(l(u),{href:e.route("clientarea.raffles.index"),class:"font-bold text-lg"},{default:c(()=>[I(g(e.$page.props.app_name),1)]),_:1},8,["href"]),r(l(u),{href:e.route("clientarea.profile.index"),class:"font-bold text-lg"},{default:c(()=>{var s,m;return[a("img",{src:f((m=(s=e.$page.props)==null?void 0:s.auth)==null?void 0:m.name),class:"w-10 h-10 object-cover rounded-full",alt:""},null,8,G)]}),_:1},8,["href"])])]),a("main",R,[a("div",S,[i(e.$slots,"options")]),a("div",q,[i(e.$slots,"header")]),i(e.$slots,"default")]),a("div",F,[a("div",H,[(o(),n(p,null,M(h,s=>r(A,{key:s.route,item:s,active:y(s.route)},null,8,["item","active"])),64))])])],64))}};export{j as I,O as _};
