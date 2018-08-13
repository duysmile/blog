
<div class="d-flex w-100">
    <div class="h-50 icon-avatar">
        <i class="fa fa-user"></i>
    </div>
    <div class="w-100">
        <p>
            <span class="text-primary">
                {{ $name }}
            </span>
            <br>
            <span>
                {{ $comment }}
            </span>
            <br>
            <span class="text-primary">
                <a href="" class="text-primary">
                    <i class="fa fa-thumbs-up mr-1">&nbsp;Like</i>
                </a>
                <a href="" class="text-primary">
                    <i class="fa fa-reply"  data-reply="1">&nbsp;Reply</i>
                </a>
            </span>
        </p>
    </div>
</div>
<ul>
    @foreach($comment->child as $child)
        <li class="d-flex w-100 flex-column border-top pt-1">
            <div class="d-flex w-100">
                <div class="h-50 icon-avatar">
                    <i class="fa fa-user"></i>
                </div>
                <div class="w-100">
                    <p>
                        <span class="text-primary">
                            {{ $name }}
                        </span>
                                    <br>
                                    <span>
                            {{ $comment }}
                        </span>
                                    <br>
                                    <span class="text-primary">
                            <a href="" class="text-primary">
                                <i class="fa fa-thumbs-up mr-1">&nbsp;Like</i>
                            </a>
                            <a href="" class="text-primary">
                                <i class="fa fa-reply"  data-reply="1">&nbsp;Reply</i>
                            </a>
                        </span>
                    </p>
                </div>
            </div>
        </li>
    @endforeach
</ul>