import{O as M,o,c as i,b as l,u as a,Z as $,d as e,f as n,g as x,i as g,F as d,l as k,t as u,k as h,n as b,q as A,p as m}from"./app-5b664324.js";import{y as V,_ as w,a as B}from"./DropdownItem-25f38af6.js";import{c as v,I as D,a as S,b as C}from"./IconUser-efff4280.js";var U=v("currency-dollar","IconCurrencyDollar",[["path",{d:"M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2",key:"svg-0"}],["path",{d:"M12 3v3m0 12v3",key:"svg-1"}]]),j=v("home","IconHome",[["path",{d:"M5 12l-2 0l9 -9l9 9l-2 0",key:"svg-0"}],["path",{d:"M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7",key:"svg-1"}],["path",{d:"M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6",key:"svg-2"}]]),G=v("users-group","IconUsersGroup",[["path",{d:"M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-0"}],["path",{d:"M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1",key:"svg-1"}],["path",{d:"M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-2"}],["path",{d:"M17 10h2a2 2 0 0 1 2 2v1",key:"svg-3"}],["path",{d:"M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-4"}],["path",{d:"M3 13v-1a2 2 0 0 1 2 -2h2",key:"svg-5"}]]);function L(){function r(){M.post(route("logout"))}return{logout:r}}function N(r){return`https://ui-avatars.com/api/?name=${r}&size=256&background=2A6049&color=fff`}const R={class:"flex"},z={class:"w-72 min-h-screen p-0 m-0 bg-white flex flex-col border hidden lg:block"},F={class:"h-full px-3 py-4 overflow-y-auto"},H={class:"flex flex-col items-center my-6"},O=e("div",{class:"h-14 w-14"},[e("img",{class:"h-full w-full",src:"/logo1x1.png",alt:""})],-1),q={class:"space-y-1"},E={key:0,class:"block text-xs text-gray-500 uppercase tracking-wider font-semibold mt-6 px-2"},P=e("span",null,"Salir",-1),T={class:"w-full"},Z={class:"bg-white mb-3 shadow"},J={class:"flex items-center justify-between px-4 py-2 mx-auto max-w-screen-lg"},K=["src"],Q={class:"px-1 py-1"},W={class:"block text-xs text-gray-400 font-semibold mt-2 px-2"},X={class:"px-1 py-1"},Y={class:"p-4 mx-auto max-w-screen-lg mb-4"},ee={class:"flex items-center overflow-x-auto hide-scrollbar"},te={class:"flex items-center justify-between mb-4"},le={__name:"ClientareaLayout",props:{title:{type:String,default:""},breads:{type:Array,default:[]}},setup(r){const{logout:c}=L(),p=[{header:"Inicio"},{icon:j,route:route("clientarea.raffles.index"),title:"Rifas"},{icon:D,route:route("clientarea.results.index"),title:"Resultados"},{icon:U,route:route("clientarea.invoices.index"),title:"Recibos"},{header:"Administración"},{icon:G,route:route("clientarea.sellers.index"),title:"Vendedores"},{header:"Cuenta"},{icon:S,route:route("clientarea.profile.index"),title:"Perfil"}],_=s=>window.location.href.includes(s);function I(s){return _(s)?"bg-green-pea-700 text-white":"hover:bg-gray-100"}return(s,y)=>(o(),i(d,null,[l(a($),{title:r.title},null,8,["title"]),e("div",R,[e("aside",z,[e("div",F,[e("div",H,[O,l(a(g),{href:s.route("clientarea.raffles.index"),class:"font-bold text-lg mt-2 text-gray-500"},{default:n(()=>[x(" ClickAsh ")]),_:1},8,["href"])]),e("ul",q,[(o(),i(d,null,k(p,t=>e("li",null,[t.header?(o(),i("span",E,u(t.header),1)):(o(),h(a(g),{key:1,href:t.route},{default:n(()=>[e("span",{class:b(["flex items-center px-2 py-3 rounded-xl gap-4",I(t.route)])},[(o(),h(A(t.icon),{class:b(_(t.route)?"text-white":"")},null,8,["class"])),e("span",null,u(t.title),1)],2)]),_:2},1032,["href"]))])),64)),e("li",null,[e("span",{onClick:y[0]||(y[0]=(...t)=>a(c)&&a(c)(...t)),class:"flex items-center px-2 py-3 rounded-lg gap-4 hover:bg-gray-100",role:"button"},[l(a(C)),P])])])])]),e("div",T,[e("nav",Z,[e("div",J,[l(a(g),{href:s.route("clientarea.raffles.index"),class:"font-bold text-lg text-gray-600"},{default:n(()=>[x(u(s.$page.props.auth.company_name),1)]),_:1},8,["href"]),l(B,{showIcon:!1},{item:n(()=>{var t,f;return[e("img",{src:a(N)((f=(t=s.$page.props)==null?void 0:t.auth)==null?void 0:f.name),class:"w-10 h-10 object-cover rounded-full",alt:""},null,8,K)]}),default:n(()=>[e("div",Q,[(o(),i(d,null,k(p,t=>(o(),i(d,null,[t.header?(o(),h(a(V),{key:0},{default:n(({active:f})=>[e("span",W,u(t.header),1)]),_:2},1024)):(o(),h(w,{key:1,href:t.route,title:t.title,icon:t.icon},null,8,["href","title","icon"]))],64))),64))]),e("div",X,[l(w,{onClick:a(c),title:"Cerrar sesión",icon:a(C)},null,8,["onClick","icon"])])]),_:1})])]),e("main",Y,[e("div",ee,[m(s.$slots,"options")]),e("div",te,[m(s.$slots,"header")]),m(s.$slots,"default")])])])],64))}};export{N as A,U as I,le as _};