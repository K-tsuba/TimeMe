<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# [TimeMe](https://nameless-meadow-62731.herokuapp.com/)

学習時間を計測し、学習のモチベーションの維持向上を図るアプリケーションです。

## 概要

コロナによりオンライン学習が発展し、webサイトなどで気軽に学習できる教材が増えています。しかしオンラインで一人で学習するのも難しいと思う方が多いと思います。そこで学習時間を計測することで1日にどれくらい学習しているを把握でき、予定を立てることに繋がったり、学習時間の可視化によりモチベーションを保つことができます。

## デモ

![JymR8jPIn5Daoe5Gocgz1639477181-1639477683](https://user-images.githubusercontent.com/90757398/145982037-c9bce235-9853-48e3-9322-1ca858dc8c91.gif)

### 主な機能
- __学習するサイトの登録__<br>
自分が学習したいサイトのタイトルを決めていただいて、urlを記入していただければこのサイトから自分が学習したいサイトへ遷移することができます。
- __時間の計測__<br>
学習するサイトを選んでいただいた後に、startのボタンを押していただくと計測することができます。
- __目標と振り返りをtwitterにツイートする__<br>
目標では学習を始める前に、今日のゴールや意気込みを宣言することで学習の意欲を高められます。また振り返りでは学んだことをアウトプットすることで記憶に残すことができます。
- __音楽の再生__<br>
学習中にやる気がなくなったり、疲れた時に気分を高めることができます。
- __他のユーザーの学習時間一覧__<br>
他のユーザーの学習時間を知ることができればお互いに頑張ろうという気持ちを共有することができ、学習の意欲保持に繋がります。
- __学習時間のランキング__<br>
ランキングがあることで競争がうまれ、学習の意欲に繋がります。
- __アウトプット投稿/質問__<br>
学習したことをアウトプットすることで自分のためになるし、相手のためにもなります。またわからないことも質問できるのでお互いに助け合うことができます。
- __自分の学習時間一覧表__<br>
1週間にどれくらい学習しているのかなどを把握することで予定を立てる時の目安になったり、時間を可視化することで自身にも繋がります。

## こだわった所

こだわったところは学習時間の表示のところです。最初は今までの学習時間を表示できたり、今日の学習時間を表示できればいいと考えていました。しかし、作っている時に１週間分でまとめられていたり、月単位での時間などを知ることができれば学習の予定管理などに役立つと思ったので様々な表示で確認できるようにこだわりました。

コード面ではControllerの肥大化するのをうまくModelを使ってコードを分かりやすいように書くことをこだわりました。最初は1週間分や1カ月分など一つ一つ丁寧に書いていたのでControllerが肥大化してしまいました。しかし、データを取得するときに範囲が異なるだけで足し方は一緒な所があったりしたのでそういったところをModelで関数にまとめControllerの肥大化を解消しました。

## 今後やっていきたいこと

時間の計測を実装することはできたので今後はカレンダーを付けたり、予定の管理などもできるようにしていきたいです。また、もっとオンライン上でもユーザー同士で繋がることができるようなアプリにしていきたいです。

サービス面だけではなくコード面でも簡単に回収できるようしていきたいのと、javascriptのフレームワークであるReactを活用しフロントの部分も強化していきたいと思っています。例えば、今は時間の計測処理のところをjavascriptで書いているのですが、フレームワークを使えばもっと簡単に書くことができると思うので今後やっていきたいと思っています。

## 環境

- PHP 7.3.30 
- Laravel Framework 6.20.34
- Twitter API v2
- YouTube Data API v3

## 文責

- 椿康平
- [Twitter](https://twitter.com/KouKou39096839)

## ライセンス

- [MIT](https://github.com/K-tsuba/TimeMe/blob/master/LICENSE)

