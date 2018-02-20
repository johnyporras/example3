<li class="{{ Request::is('feeds*') ? 'active' : '' }}">
    <a href="{!! route('feeds.index') !!}"><i class="fa fa-edit"></i><span>Feeds</span></a>
</li>

<li class="{{ Request::is('feeds*') ? 'active' : '' }}">
    <a href="/memeimporter/readarticles"><i class="fa fa-edit"></i><span>Execute Pocesses</span></a>
</li>

<li class="{{ Request::is('feeds*') ? 'active' : '' }}">
    <a href="/memeimporter/listarticles"><i class="fa fa-edit"></i><span>Read Articles</span></a>
</li>

