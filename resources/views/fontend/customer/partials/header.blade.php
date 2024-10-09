<div class="row ac-header">
    <div class="col-md-6">
        <div class="left">
            <span class="avatar">
                <img src="{{ Auth::guard('customer')->user()->avatar == 'default.png' ? asset('pictures/user.png') : asset(Auth::guard('customer')->user()->avatar) }}" width="80" height="80" alt="{{ Auth::guard('customer')->user()->name }} Photo">
            </span>
            <div class="name">
                <p>Hello,</p>
                <p class="user">{{ Auth::guard('customer')->user()->name }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="right">
            <div class="balance">
                <span class="blurb">Star Points</span>
                <span class="amount">0</span>
            </div>
            <div class="balance">
                <span class="blurb">Store Credit</span>
                <span class="amount">0</span>
            </div>
        </div>
    </div>
</div>