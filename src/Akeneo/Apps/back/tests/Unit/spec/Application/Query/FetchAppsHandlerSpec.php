<?php

declare(strict_types=1);

namespace spec\Akeneo\Apps\Application\Query;

use Akeneo\Apps\Application\Query\FetchAppsHandler;
use Akeneo\Apps\Domain\Model\Read\App;
use Akeneo\Apps\Domain\Model\Write\FlowType;
use Akeneo\Apps\Domain\Persistence\Repository\AppRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @author Romain Monceau <romain@akeneo.com>
 * @copyright 2019 Akeneo SAS (http://www.akeneo.com)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
class FetchAppsHandlerSpec extends ObjectBehavior
{
    public function let(AppRepository $repository)
    {
        $this->beConstructedWith($repository);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(FetchAppsHandler::class);
    }

    public function it_fetches_apps($repository)
    {
        $apps = [
            new App('magento', 'Magento Connector', FlowType::DATA_DESTINATION),
            new App('bynder', 'Bynder DAM', FlowType::OTHER),
        ];

        $repository->fetchAll()->willReturn($apps);

        $this->query()->shouldReturn($apps);
    }
}
