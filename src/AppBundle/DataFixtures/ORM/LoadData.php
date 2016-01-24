<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Car;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\File;

class LoadData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userAdmin = $manager->getRepository('AppBundle:User')->findOneBy(['username' => 'admin']);
        $userManager = $this->container->get('fos_user.user_manager');

        if (null === $userAdmin) {
            $userAdmin = new User();
        }

        $userAdmin->setUsername('admin');
        $userAdmin->setPlainPassword('test');
        $userAdmin
            ->setRoles(['ROLE_ADMIN'])
            ->setEmail('admin@o2.pl')
            ->setEnabled(true);



        $cars[] = new Car('Pegout 308', 2008, 3, new File('web/images/products/z14590634Q,Nowy-Peugeot-308.jpg'), 300);
        $cars[] = new Car('Porsche 911', 2010, 1, new File('web/images/products/porshe.jpg'), 1300);
        $cars[] = new Car('BMW x6', 2015, 2, new File('web/images/products/maxresdefault.jpg'), 900);
        $cars[] = new Car('Mazda x3', 2014, 2, new File('web/images/products/001-2016-mazda-cx-3-live_628opt.jpg'), 400);
        $cars[] = new Car('Mazda 3', 2012, 4, new File('web/images/products/mazda3-hatchback-gallery-04.jpg'), 330);

        foreach ($cars as $car) {
            $manager->persist($car);
        }

        $manager->persist($userAdmin);
        $manager->flush();
        $userManager->updateUser($userAdmin, true);

    }


}