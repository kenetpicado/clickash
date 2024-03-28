import{o,c as n,b as l,u as a,Z as I,d as e,f as r,i as m,F as c,l as x,t as d,k as u,n as k,s as M,g as $,q as g}from"./app-b9c931a0.js";import{y as A,_ as b,a as V}from"./DropdownItem-b62aa329.js";import{u as j}from"./useAuth-6ae4d293.js";import{c as v}from"./createVueComponent-5a0326f8.js";import{I as B,a as D,b as w}from"./IconUser-5bef4d49.js";var L=v("currency-dollar","IconCurrencyDollar",[["path",{d:"M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2",key:"svg-0"}],["path",{d:"M12 3v3m0 12v3",key:"svg-1"}]]),S=v("home","IconHome",[["path",{d:"M5 12l-2 0l9 -9l9 9l-2 0",key:"svg-0"}],["path",{d:"M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7",key:"svg-1"}],["path",{d:"M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6",key:"svg-2"}]]),U=v("users-group","IconUsersGroup",[["path",{d:"M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-0"}],["path",{d:"M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1",key:"svg-1"}],["path",{d:"M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-2"}],["path",{d:"M17 10h2a2 2 0 0 1 2 2v1",key:"svg-3"}],["path",{d:"M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-4"}],["path",{d:"M3 13v-1a2 2 0 0 1 2 -2h2",key:"svg-5"}]]);function G(h){return`https://ui-avatars.com/api/?name=${h}&size=256&background=2A6049&color=fff`}const N={class:"flex"},R={class:"w-72 min-h-screen p-0 m-0 bg-white flex flex-col border hidden lg:block"},z={class:"h-full px-3 py-4 overflow-y-auto"},F={class:"flex flex-col items-center my-6"},H=e("img",{class:"h-full w-full rounded-xl",src:"/CA-LogoText.jpg",alt:""},null,-1),T={class:"space-y-1"},q={key:0,class:"block text-xs text-gray-500 uppercase tracking-wider font-semibold mt-6 px-2"},E=e("span",null,"Salir",-1),P={class:"w-full"},Z={class:"bg-white mb-3 shadow"},J={class:"flex items-center justify-between px-4 py-2 mx-auto max-w-screen-lg"},K=["src"],O={class:"px-1 py-1"},Q={class:"block text-xs text-gray-400 font-semibold mt-2 px-2"},W={class:"px-1 py-1"},X={class:"p-4 mx-auto max-w-screen-lg mb-4"},Y={class:"flex items-center overflow-x-auto hide-scrollbar"},ee={class:"flex items-center justify-between mb-4"},re={__name:"ClientareaLayout",props:{title:{type:String,default:""},breads:{type:Array,default:[]}},setup(h){const{logout:i}=j(),p=[{header:"Inicio"},{icon:S,route:route("clientarea.raffles.index"),title:"Rifas"},{icon:B,route:route("clientarea.results.index"),title:"Resultados"},{icon:L,route:route("clientarea.invoices.index"),title:"Recibos"},{header:"Administración"},{icon:U,route:route("clientarea.sellers.index"),title:"Vendedores"},{header:"Cuenta"},{icon:D,route:route("clientarea.profile.index"),title:"Perfil"}],_=s=>window.location.href.includes(s);function C(s){return _(s)?"bg-green-pea-700 text-white":"hover:bg-gray-100"}return(s,y)=>(o(),n(c,null,[l(a(I),{title:h.title},null,8,["title"]),e("div",N,[e("aside",R,[e("div",z,[e("div",F,[l(a(m),{href:s.route("clientarea.raffles.index"),class:"h-20 w-20"},{default:r(()=>[H]),_:1},8,["href"])]),e("ul",T,[(o(),n(c,null,x(p,t=>e("li",null,[t.header?(o(),n("span",q,d(t.header),1)):(o(),u(a(m),{key:1,href:t.route},{default:r(()=>[e("span",{class:k(["flex items-center px-2 py-3 rounded-xl gap-4",C(t.route)])},[(o(),u(M(t.icon),{class:k(_(t.route)?"text-white":"")},null,8,["class"])),e("span",null,d(t.title),1)],2)]),_:2},1032,["href"]))])),64)),e("li",null,[e("span",{onClick:y[0]||(y[0]=(...t)=>a(i)&&a(i)(...t)),class:"flex items-center px-2 py-3 rounded-lg gap-4 hover:bg-gray-100",role:"button"},[l(a(w)),E])])])])]),e("div",P,[e("nav",Z,[e("div",J,[l(a(m),{href:s.route("clientarea.raffles.index"),class:"font-bold text-lg text-gray-600"},{default:r(()=>[$(d(s.$page.props.auth.company_name),1)]),_:1},8,["href"]),l(V,{showIcon:!1},{item:r(()=>{var t,f;return[e("img",{src:a(G)((f=(t=s.$page.props)==null?void 0:t.auth)==null?void 0:f.name),class:"w-10 h-10 object-cover rounded-full",alt:""},null,8,K)]}),default:r(()=>[e("div",O,[(o(),n(c,null,x(p,t=>(o(),n(c,null,[t.header?(o(),u(a(A),{key:0},{default:r(({active:f})=>[e("span",Q,d(t.header),1)]),_:2},1024)):(o(),u(b,{key:1,href:t.route,title:t.title,icon:t.icon},null,8,["href","title","icon"]))],64))),64))]),e("div",W,[l(b,{onClick:a(i),title:"Cerrar sesión",icon:a(w)},null,8,["onClick","icon"])])]),_:1})])]),e("main",X,[e("div",Y,[g(s.$slots,"options")]),e("div",ee,[g(s.$slots,"header")]),g(s.$slots,"default")])])])],64))}};export{G as A,L as I,re as _};