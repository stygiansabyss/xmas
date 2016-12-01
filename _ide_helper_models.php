<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Services\Administrating\Models{
/**
 * App\Services\Administrating\Models\Asset
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property int $width
 * @property int $height
 * @property bool $charity_flag
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Asset whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Asset whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Asset wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Asset whereWidth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Asset whereHeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Asset whereCharityFlag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Asset whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Asset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel active()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 */
	class Asset extends \Eloquent {}
}

namespace App\Services\Administrating\Models{
/**
 * App\Services\Administrating\Models\Setting
 *
 * @property int $id
 * @property string $name
 * @property string $label
 * @property string $value
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Setting whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Setting whereLabel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Setting whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Setting whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Administrating\Models\Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel active()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 */
	class Setting extends \Eloquent {}
}

namespace App\Services\Donating\Models{
/**
 * App\Services\Donating\Models\Donation
 *
 * @property int $id
 * @property string $hb_id
 * @property int $amount
 * @property string $name
 * @property string $email
 * @property string $comment
 * @property bool $read_flag
 * @property bool $shown_flag
 * @property \Carbon\Carbon $hb_created_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $created_at_readable
 * @property-read mixed $created_at_short
 * @property-read mixed $sanitized_comment
 * @property-read mixed $amount_raw
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation whereHbId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation whereReadFlag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation whereShownFlag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation whereHbCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation withComment()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation shown()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Donation read()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel active()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 */
	class Donation extends \Eloquent {}
}

namespace App\Services\Donating\Models{
/**
 * App\Services\Donating\Models\Total
 *
 * @property int $id
 * @property int $raised
 * @property string $reason
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $raised_raw
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Total whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Total whereRaised($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Total whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Total whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Donating\Models\Total whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel active()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 */
	class Total extends \Eloquent {}
}

namespace App\Services\Goals\Models{
/**
 * App\Services\Goals\Models\Goal
 *
 * @property int $id
 * @property int $start_value
 * @property int $goal
 * @property \Carbon\Carbon $reached_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $reached_at_short
 * @property-read mixed $percent
 * @property-read mixed $duration
 * @property-read mixed $difference
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Goals\Models\Goal whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Goals\Models\Goal whereStartValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Goals\Models\Goal whereGoal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Goals\Models\Goal whereReachedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Goals\Models\Goal whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Goals\Models\Goal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Goals\Models\Goal active()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 */
	class Goal extends \Eloquent {}
}

namespace App\Services\Incentivizing\Models{
/**
 * App\Services\Incentivizing\Models\Incentive
 *
 * @property int $id
 * @property int $target
 * @property int $count
 * @property string $reward
 * @property \Carbon\Carbon $reached_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $reached_at_short
 * @property-read mixed $percent
 * @property-read mixed $duration
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Incentivizing\Models\Incentive whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Incentivizing\Models\Incentive whereTarget($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Incentivizing\Models\Incentive whereCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Incentivizing\Models\Incentive whereReward($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Incentivizing\Models\Incentive whereReachedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Incentivizing\Models\Incentive whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Incentivizing\Models\Incentive whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Incentivizing\Models\Incentive active()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 */
	class Incentive extends \Eloquent {}
}

namespace App\Services\Raffling\Models{
/**
 * App\Services\Raffling\Models\Raffle
 *
 * @property int $id
 * @property string $name
 * @property bool $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $entries
 * @property-read \NukaCode\Database\Collection|\App\Services\Raffling\Models\Tier[] $tiers
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Raffle whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Raffle whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Raffle whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Raffle whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Raffle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Raffle active()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Raffle finished()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 */
	class Raffle extends \Eloquent {}
}

namespace App\Services\Raffling\Models{
/**
 * App\Services\Raffling\Models\Tier
 *
 * @property int $id
 * @property int $raffle_id
 * @property bool $status
 * @property int $minimum
 * @property string $reward
 * @property bool $level
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $simple_amount
 * @property-read mixed $unshown_winners
 * @property-read mixed $entries
 * @property-read mixed $winner_count
 * @property-read mixed $email
 * @property-read \App\Services\Raffling\Models\Raffle $raffle
 * @property-read \NukaCode\Database\Collection|\App\Services\Donating\Models\Donation[] $donations
 * @property-read \NukaCode\Database\Collection|\App\Services\Donating\Models\Donation[] $winners
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Tier whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Tier whereRaffleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Tier whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Tier whereMinimum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Tier whereReward($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Tier whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Tier whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Tier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Tier active()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Raffling\Models\Tier finished()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 */
	class Tier extends \Eloquent {}
}

namespace App\Services\StreamLabs\Models{
/**
 * App\Services\StreamLabs\Models\Alert
 *
 * @property int $id
 * @property string $name
 * @property string $sound_href
 * @property string $image_href
 * @property string $template
 * @property int $minimum_amount
 * @property bool $exact_flag
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $minimum_amount_raw
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Alert whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Alert whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Alert whereSoundHref($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Alert whereImageHref($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Alert whereTemplate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Alert whereMinimumAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Alert whereExactFlag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Alert whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Alert whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel active()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 */
	class Alert extends \Eloquent {}
}

namespace App\Services\StreamLabs\Models{
/**
 * App\Services\StreamLabs\Models\Token
 *
 * @property integer $id
 * @property integer $twitch_id
 * @property string $channel
 * @property string $api_token
 * @property string $access_token
 * @property string $refresh_token
 * @property \Carbon\Carbon $expires_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereTwitchId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereChannel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereApiToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereAccessToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereRefreshToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereExpiresAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\StreamLabs\Models\Token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel active()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 * @mixin \Eloquent
 */
	class Token extends \Eloquent {}
}

namespace App\Services\Tweeting\Models{
/**
 * App\Services\Tweeting\Models\Tweet
 *
 * @property int $id
 * @property int $twitter_id
 * @property string $text
 * @property string $name
 * @property bool $shown_flag
 * @property \Carbon\Carbon $twitter_created_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Tweeting\Models\Tweet whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Tweeting\Models\Tweet whereTwitterId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Tweeting\Models\Tweet whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Tweeting\Models\Tweet whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Tweeting\Models\Tweet whereShownFlag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Tweeting\Models\Tweet whereTwitterCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Tweeting\Models\Tweet whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Tweeting\Models\Tweet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel active()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 */
	class Tweet extends \Eloquent {}
}

namespace App\Services\Voting\Models{
/**
 * App\Services\Voting\Models\Option
 *
 * @property int $id
 * @property int $vote_id
 * @property string $key_word
 * @property int $votes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $percent
 * @property-read mixed $percent_overlay
 * @property-read \App\Services\Voting\Models\Vote $vote
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Option whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Option whereVoteId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Option whereKeyWord($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Option whereVotes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel active()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 */
	class Option extends \Eloquent {}
}

namespace App\Services\Voting\Models{
/**
 * App\Services\Voting\Models\Vote
 *
 * @property int $id
 * @property string $name
 * @property bool $accepting_flag
 * @property bool $status
 * @property int $percent
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $options_readable
 * @property-read \NukaCode\Database\Collection|\App\Services\Voting\Models\Option[] $options
 * @property mixed $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Vote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Vote whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Vote whereAcceptingFlag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Vote whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Vote wherePercent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Vote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Vote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Vote accepting()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Vote active()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Voting\Models\Vote finished()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByCreatedAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel orderByNameAsc()
 * @method static \Illuminate\Database\Query\Builder|\NukaCode\Core\Models\BaseModel inactive()
 */
	class Vote extends \Eloquent {}
}

