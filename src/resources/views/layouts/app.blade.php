<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kartech') }}</title>

    <link rel="icon" type="image/png" href="https://static.kartech-app.com/images/k.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/original.js') . '?20211024' }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/original.css') . '?20211024' }}" rel="stylesheet">
</head>
<body class="bg-origin-body">
    <div id="app">
        @unless (\Route::is('customers.create'))
        @guest
        <nav class="navbar navbar-expand-lg navbar-light bg-origin-nav fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('top') }}">
                    <h1 class="font-origin-title">Kartech</h1>
                </a>
        @else
        <nav class="navbar navbar-expand-lg navbar-light bg-origin-nav fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('customers.index') }}">
                    <h1 class="font-origin-title">Kartech</h1>
                </a>
        @endguest
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item mr-4">
                            <a href="{{ route('login.guest') }}" class="nav-link">ゲストログイン</a>
                        </li>
                        <li class="nav-item mr-4">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('ユーザー登録') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                顧客管理
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('customers.index') }}">顧客一覧・検索</a>
                                <a class="dropdown-item" href="{{ route('customers.create') }}" target="_blank" rel="noopener">顧客新規追加</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                設定
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('menus.index') }}">提供メニュー設定</a>
                                <a class="dropdown-item" href="{{ route('surveys.create') }}">お客様アンケート作成</a>
                                <a class="dropdown-item" href="{{ route('consent_forms.create') }}">サービス提供同意書の作成</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endunless
    </div>
    <main>
        @include('layouts.flash_messages')
        @yield('content')
    </main>
    @unless (\Route::is('customers.create'))
    <div class="wrapper-origin">
        <footer>
            <nav class="nav justify-content-center">
                <a href="#" class="nav-link footer-text" data-toggle="modal" data-target="#site-policy">サイトポリシー</a>
                <div class="modal fade" id="site-policy">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">サイトポリシー</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body top-text">
                                <h1 class="policy-title">利用規約</h1>
                                <p>この利用規約（以下，「本規約」といいます。）は，当社がこのウェブサイト上で提供するサービス（以下，「本サービス」といいます。）の利用条件を定めるものです。登録ユーザーの皆さま（以下，「ユーザー」といいます。）には，本規約に従って，本サービスをご利用いただきます。</p>

                                <h2 class="policy">第1条（適用）</h2>
                                <ol>
                                    <li>本規約は，ユーザーと当社との間の本サービスの利用に関わる一切の関係に適用されるものとします。</li>
                                    <li>当社は本サービスに関し，本規約のほか，ご利用にあたってのルール等，各種の定め（以下，「個別規定」といいます。）をすることがあります。これら個別規定はその名称のいかんに関わらず，本規約の一部を構成するものとします。</li>
                                    <li>本規約の規定が前条の個別規定の規定と矛盾する場合には，個別規定において特段の定めなき限り，個別規定の規定が優先されるものとします。</li>
                                </ol>
                                <h2 class="policy">第2条（利用登録）</h2>
                                <ol>
                                    <li>本サービスにおいては，登録希望者が本規約に同意の上，当社の定める方法によって利用登録を申請し，当社がこれを承認することによって，利用登録が完了するものとします。</li>
                                    <li>当社は，利用登録の申請者に以下の事由があると判断した場合，利用登録の申請を承認しないことがあり，その理由については一切の開示義務を負わないものとします。
                                    <ul>
                                        <li>利用登録の申請に際して虚偽の事項を届け出た場合</li>
                                        <li>本規約に違反したことがある者からの申請である場合</li>
                                        <li>その他，当社が利用登録を相当でないと判断した場合</li>
                                    </ul>
                                </ol>
                                <h2 class="policy">第3条（ユーザーIDおよびパスワードの管理）</h2>
                                <ol>
                                    <li>ユーザーは，自己の責任において，本サービスのユーザーIDおよびパスワードを適切に管理するものとします。</li>
                                    <li>ユーザーは，いかなる場合にも，ユーザーIDおよびパスワードを関係者外に譲渡または貸与し，もしくは関係者外と共用することはできません。当社は，ユーザーIDとパスワードの組み合わせが登録情報と一致してログインされた場合には，そのユーザーIDを登録しているユーザー自身による利用とみなします。</li>
                                    <li>ユーザーID及びパスワードが第三者によって使用されたことによって生じた損害は，当社に故意又は重大な過失がある場合を除き，当社は一切の責任を負わないものとします。</li>
                                </ol>
                                <h2 class="policy">第4条（利用料金および支払方法）</h2>
                                <ol>
                                    <li>ユーザーは，本サービスの有料部分の対価として，当社が別途定め，本ウェブサイトに表示する利用料金を，当社が指定する方法により支払うものとします。</li>
                                    <li>ユーザーが利用料金の支払を遅滞した場合には，ユーザーは年14．6％の割合による遅延損害金を支払うものとします。</li>
                                </ol>
                                <h2 class="policy">第5条（禁止事項）</h2>
                                <p>ユーザーは，本サービスの利用にあたり，以下の行為をしてはなりません。</p>
                                <ol>
                                    <li>法令または公序良俗に違反する行為</li>
                                    <li>犯罪行為に関連する行為</li>
                                    <li>本サービスの内容等，本サービスに含まれる著作権，商標権ほか知的財産権を侵害する行為</li>
                                    <li>当社，ほかのユーザー，またはその他第三者のサーバーまたはネットワークの機能を破壊したり，妨害したりする行為</li>
                                    <li>本サービスによって得られた情報を商業的に利用する行為</li>
                                    <li>当社のサービスの運営を妨害するおそれのある行為</li>
                                    <li>不正アクセスをし，またはこれを試みる行為</li>
                                    <li>他のユーザーに関する個人情報等を収集または蓄積する行為</li>
                                    <li>不正な目的を持って本サービスを利用する行為</li>
                                    <li>本サービスの他のユーザーまたはその他の第三者に不利益，損害，不快感を与える行為</li>
                                    <li>他のユーザーに成りすます行為</li>
                                    <li>当社が許諾しない本サービス上での宣伝，広告，勧誘，または営業行為</li>
                                    <li>面識のない異性との出会いを目的とした行為</li>
                                    <li>当社のサービスに関連して，反社会的勢力に対して直接または間接に利益を供与する行為</li>
                                    <li>その他，当社が不適切と判断する行為</li>
                                </ol>

                                <h2 class="policy">第6条（本サービスの提供の停止等）</h2>
                                <ol>
                                    <li>当社は，以下のいずれかの事由があると判断した場合，ユーザーに事前に通知することなく本サービスの全部または一部の提供を停止または中断することができるものとします。
                                    <ul>
                                        <li>本サービスにかかるコンピュータシステムの保守点検または更新を行う場合</li>
                                        <li>地震，落雷，火災，停電または天災などの不可抗力により，本サービスの提供が困難となった場合</li>
                                        <li>コンピュータまたは通信回線等が事故により停止した場合</li>
                                        <li>その他，当社が本サービスの提供が困難と判断した場合</li>
                                        <li>当社は，本サービスの提供の停止または中断により，ユーザーまたは第三者が被ったいかなる不利益または損害についても，一切の責任を負わないものとします。</li>
                                    </ul>
                                </ol>
                                <h2 class="policy">第7条（利用制限および登録抹消）</h2>
                                <ol>
                                    <li>当社は，ユーザーが以下のいずれかに該当する場合には，事前の通知なく，ユーザーに対して，本サービスの全部もしくは一部の利用を制限し，またはユーザーとしての登録を抹消することができるものとします。
                                    <li>本規約のいずれかの条項に違反した場合</li>
                                    <li>登録事項に虚偽の事実があることが判明した場合</li>
                                    <li>料金等の支払債務の不履行があった場合</li>
                                    <li>当社からの連絡に対し，一定期間返答がない場合</li>
                                    <li>本サービスについて，最終の利用から一定期間利用がない場合</li>
                                    <li>その他，当社が本サービスの利用を適当でないと判断した場合</li>
                                    <li>当社は，本条に基づき当社が行った行為によりユーザーに生じた損害について，一切の責任を負いません。</li>
                                </ol>
                                <h2 class="policy">第8条（退会）</h2>
                                <p>ユーザーは，当社の定める退会手続により，本サービスから退会できるものとします。</p>
                                <h2 class="policy">第9条（保証の否認および免責事項）</h2>
                                <ol>
                                    <li>当社は，本サービスに事実上または法律上の瑕疵（安全性，信頼性，正確性，完全性，有効性，特定の目的への適合性，セキュリティなどに関する欠陥，エラーやバグ，権利侵害などを含みます。）がないことを明示的にも黙示的にも保証しておりません。</li>
                                    <li>当社は，本サービスに起因してユーザーに生じたあらゆる損害について一切の責任を負いません。ただし，本サービスに関する当社とユーザーとの間の契約（本規約を含みます。）が消費者契約法に定める消費者契約となる場合，この免責規定は適用されません。</li>
                                    <li>前項ただし書に定める場合であっても，当社は，当社の過失（重過失を除きます。）による債務不履行または不法行為によりユーザーに生じた損害のうち特別な事情から生じた損害（当社またはユーザーが損害発生につき予見し，または予見し得た場合を含みます。）について一切の責任を負いません。また，当社の過失（重過失を除きます。）による債務不履行または不法行為によりユーザーに生じた損害の賠償は，ユーザーから当該損害が発生した月に受領した利用料の額を上限とします。</li>
                                    <li>当社は，本サービスに関して，ユーザーと他のユーザーまたは第三者との間において生じた取引，連絡または紛争等について一切責任を負いません。</li>
                                </ol>
                                <h2 class="policy">第10条（サービス内容の変更等）</h2>
                                <p>当社は，ユーザーに通知することなく，本サービスの内容を変更しまたは本サービスの提供を中止することができるものとし，これによってユーザーに生じた損害について一切の責任を負いません。</p>
                                <h2 class="policy">第11条（利用規約の変更）</h2>
                                <p>当社は，必要と判断した場合には，ユーザーに通知することなくいつでも本規約を変更することができるものとします。なお，本規約の変更後，本サービスの利用を開始した場合には，当該ユーザーは変更後の規約に同意したものとみなします。</p>
                                <h2 class="policy">第12条（個人情報の取扱い）</h2>
                                <p>当社は，本サービスの利用によって取得する個人情報については，当社「プライバシーポリシー」に従い適切に取り扱うものとします。</p>
                                <h2 class="policy">第13条（通知または連絡）</h2>
                                <p>ユーザーと当社との間の通知または連絡は，当社の定める方法によって行うものとします。当社は,ユーザーから,当社が別途定める方式に従った変更届け出がない限り,現在登録されている連絡先が有効なものとみなして当該連絡先へ通知または連絡を行い,これらは,発信時にユーザーへ到達したものとみなします。</p>
                                <h2 class="policy">第14条（権利義務の譲渡の禁止）</h2>
                                <p>ユーザーは，当社の書面による事前の承諾なく，利用契約上の地位または本規約に基づく権利もしくは義務を第三者に譲渡し，または担保に供することはできません。</p>
                                <h2 class="policy">第15条（準拠法・裁判管轄）</h2>
                                <ol>
                                    <li>本規約の解釈にあたっては，日本法を準拠法とします。</li>
                                    <li>本サービスに関して紛争が生じた場合には，当社の本店所在地を管轄する裁判所を専属的合意管轄とします。</li>
                                </ol>
                                <p>以上</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" class="nav-link footer-text" data-toggle="modal" data-target="#privacy-policy">プライバシーポリシー</a>
                <div class="modal fade" id="privacy-policy">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title policy-title">プライバシーポリシー</h3>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body top-text">
                                <p>当社は，本ウェブサイト上で提供するサービス（以下,「本サービス」といいます。）における，ユーザーの個人情報の取扱いについて，以下のとおりプライバシーポリシー（以下，「本ポリシー」といいます。）を定めます。</p>
                                <h2 class="policy">第1条（個人情報）</h2>
                                <p>「個人情報」とは，個人情報保護法にいう「個人情報」を指すものとし，生存する個人に関する情報であって，当該情報に含まれる氏名，生年月日，住所，電話番号，連絡先その他の記述等により特定の個人を識別できる情報及び容貌，指紋，声紋にかかるデータ，及び健康保険証の保険者番号などの当該情報単体から特定の個人を識別できる情報（個人識別情報）を指します。</p>
                                <h2 class="policy">第2条（個人情報の収集方法）</h2>
                                <p>当社は，ユーザーが利用登録をする際に氏名，生年月日，住所，電話番号，メールアドレス，銀行口座番号，クレジットカード番号，運転免許証番号などの個人情報をお尋ねすることがあります。また，ユーザーと提携先などとの間でなされたユーザーの個人情報を含む取引記録や決済に関する情報を,当社の提携先（情報提供元，広告主，広告配信先などを含みます。以下，｢提携先｣といいます。）などから収集することがあります。</p>
                                <h2 class="policy">第3条（個人情報を収集・利用する目的）</h2>
                                <p>当社が個人情報を収集・利用する目的は，以下のとおりです。</p>
                                <ol>
                                    <li>当社サービスの提供・運営のため</li>
                                    <li>ユーザーからのお問い合わせに回答するため（本人確認を行うことを含む）</li>
                                    <li>ユーザーが利用中のサービスの新機能，更新情報，キャンペーン等及び当社が提供する他のサービスの案内のメールを送付するため</li>
                                    <li>メンテナンス，重要なお知らせなど必要に応じたご連絡のため</li>
                                    <li>利用規約に違反したユーザーや，不正・不当な目的でサービスを利用しようとするユーザーの特定をし，ご利用をお断りするため</li>
                                    <li>ユーザーにご自身の登録情報の閲覧や変更，削除，ご利用状況の閲覧を行っていただくため</li>
                                    <li>有料サービスにおいて，ユーザーに利用料金を請求するため</li>
                                    <li>上記の利用目的に付随する目的</li>
                                </ol>
                                <h2 class="policy">第4条（利用目的の変更）</h2>
                                <ol>
                                    <li>当社は，利用目的が変更前と関連性を有すると合理的に認められる場合に限り，個人情報の利用目的を変更するものとします。</li>
                                    <li>利用目的の変更を行った場合には，変更後の目的について，当社所定の方法により，ユーザーに通知し，または本ウェブサイト上に公表するものとします。</li>
                                </ol>
                                <h2 class="policy">第5条（個人情報の第三者提供）</h2>
                                <ol>
                                    <li>当社は，次に掲げる場合を除いて，あらかじめユーザーの同意を得ることなく，第三者に個人情報を提供することはありません。ただし，個人情報保護法その他の法令で認められる場合を除きます。
                                        <ol>
                                        <li>人の生命，身体または財産の保護のために必要がある場合であって，本人の同意を得ることが困難であるとき</li>
                                        <li>公衆衛生の向上または児童の健全な育成の推進のために特に必要がある場合であって，本人の同意を得ることが困難であるとき</li>
                                        <li>国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって，本人の同意を得ることにより当該事務の遂行に支障を及ぼすおそれがあるとき</li>
                                        <li>予め次の事項を告知あるいは公表し，かつ当社が個人情報保護委員会に届出をしたとき
                                            <ol>
                                                <li>利用目的に第三者への提供を含むこと</li>
                                                <li>第三者に提供されるデータの項目</li>
                                                <li>第三者への提供の手段または方法</li>
                                                <li>本人の求めに応じて個人情報の第三者への提供を停止すること</li>
                                                <li>本人の求めを受け付ける方法</li>
                                            </ol>
                                        </li>
                                        </ol>
                                    </li>
                                    <li>前項の定めにかかわらず，次に掲げる場合には，当該情報の提供先は第三者に該当しないものとします。
                                        <ol>
                                        <li>当社が利用目的の達成に必要な範囲内において個人情報の取扱いの全部または一部を委託する場合</li>
                                        <li>合併その他の事由による事業の承継に伴って個人情報が提供される場合</li>
                                        <li>個人情報を特定の者との間で共同して利用する場合であって，その旨並びに共同して利用される個人情報の項目，共同して利用する者の範囲，利用する者の利用目的および当該個人情報の管理について責任を有する者の氏名または名称について，あらかじめ本人に通知し，または本人が容易に知り得る状態に置いた場合</li>
                                        </ol>
                                    </li>
                                </ol>
                                <h2 class="policy">第6条（個人情報の開示）</h2>
                                <ol>
                                    <li>当社は，本人から個人情報の開示を求められたときは，本人に対し，遅滞なくこれを開示します。ただし，開示することにより次のいずれかに該当する場合は，その全部または一部を開示しないこともあり，開示しない決定をした場合には，その旨を遅滞なく通知します。なお，個人情報の開示に際しては，1件あたり1，000円の手数料を申し受けます。
                                        <ol>
                                        <li>本人または第三者の生命，身体，財産その他の権利利益を害するおそれがある場合</li>
                                        <li>当社の業務の適正な実施に著しい支障を及ぼすおそれがある場合</li>
                                        <li>その他法令に違反することとなる場合</li>
                                        </ol>
                                    </li>
                                    <li>前項の定めにかかわらず，履歴情報および特性情報などの個人情報以外の情報については，原則として開示いたしません。</li>
                                </ol>
                                <h2 class="policy">第7条（個人情報の訂正および削除）</h2>
                                <ol>
                                    <li>ユーザーは，当社の保有する自己の個人情報が誤った情報である場合には，当社が定める手続きにより，当社に対して個人情報の訂正，追加または削除（以下，「訂正等」といいます。）を請求することができます。</li>
                                    <li>当社は，ユーザーから前項の請求を受けてその請求に応じる必要があると判断した場合には，遅滞なく，当該個人情報の訂正等を行うものとします。</li>
                                    <li>当社は，前項の規定に基づき訂正等を行った場合，または訂正等を行わない旨の決定をしたときは遅滞なく，これをユーザーに通知します。</li>
                                </ol>
                                <h2 class="policy">第8条（個人情報の利用停止等）</h2>
                                <ol>
                                    <li>当社は，本人から，個人情報が，利用目的の範囲を超えて取り扱われているという理由，または不正の手段により取得されたものであるという理由により，その利用の停止または消去（以下，「利用停止等」といいます。）を求められた場合には，遅滞なく必要な調査を行います。</li>
                                    <li>前項の調査結果に基づき，その請求に応じる必要があると判断した場合には，遅滞なく，当該個人情報の利用停止等を行います。</li>
                                    <li>当社は，前項の規定に基づき利用停止等を行った場合，または利用停止等を行わない旨の決定をしたときは，遅滞なく，これをユーザーに通知します。</li>
                                    <li>前2項にかかわらず，利用停止等に多額の費用を有する場合その他利用停止等を行うことが困難な場合であって，ユーザーの権利利益を保護するために必要なこれに代わるべき措置をとれる場合は，この代替策を講じるものとします。</li>
                                </ol>
                                <h2 class="policy">第9条（プライバシーポリシーの変更）</h2>
                                <ol>
                                    <li>本ポリシーの内容は，法令その他本ポリシーに別段の定めのある事項を除いて，ユーザーに通知することなく，変更することができるものとします。</li>
                                    <li>当社が別途定める場合を除いて，変更後のプライバシーポリシーは，本ウェブサイトに掲載したときから効力を生じるものとします。</li>
                                </ol>
                                <h2 class="policy">第10条（お問い合わせ窓口）</h2>
                                <p>本ポリシーに関するお問い合わせは，下記のメールアドレスまでお願いいたします。</p>
                                <p>Eメールアドレス：sucness@gmail.com</p>
                                <p>以上</p>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <span class="footer-text">Copyright © Kartech 2021 Developed by </span>
            <a href="https://twitter.com/kzk_engineer" class="footer-text">@kzk-engineer</a>
        </footer>
    </div>
    @endunless
</body>
</html>
