<?php

namespace Sample\Order\Console\Command;

use Magento\Framework\App\Area;
use Magento\Framework\App\State;
use Magento\Sales\Model\Service\OrderService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HoldCommand extends Command
{
    /** @var State */
    protected $state;

    /** @var OrderService */
    private $orderService;

    public function __construct(
        State $state,
        OrderService $orderService
    ) {
        parent::__construct();
        $this->state = $state;
        $this->orderService = $orderService;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('sample:order:hold');
        $this->setDescription('Hold an order');
        $this->addArgument('order_id', InputArgument::REQUIRED, 'Order ID to hold.');
        parent::configure();
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode(Area::AREA_ADMINHTML);
        $orderId = $input->getArgument('order_id');
        $this->orderService->hold($orderId);
    }
}
