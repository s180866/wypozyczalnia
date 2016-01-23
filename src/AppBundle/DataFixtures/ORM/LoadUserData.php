<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
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


        $manager->persist($userAdmin);
        $manager->flush();
        $userManager->updateUser($userAdmin, true);
    }
}