-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23-Nov-2016 às 19:35
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `escola`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `codAluno` int(11) NOT NULL,
  `log_aluno` varchar(255) NOT NULL,
  `senha` varchar(25) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `curso` varchar(100) NOT NULL,
  `dataNasc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`codAluno`, `log_aluno`, `senha`, `nome`, `endereco`, `curso`, `dataNasc`) VALUES
(1, 'Edmar', '123', 'Edmar', '123', 'CCO', '2016-05-04'),
(2, 'Testezinho', '123', 'teste', 'Rua', 'CCo', '1991-06-13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `codAvaliacao` int(11) NOT NULL,
  `nroQuestoes` int(11) NOT NULL,
  `DATA` date NOT NULL,
  `codTurma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao_aluno`
--

CREATE TABLE `avaliacao_aluno` (
  `codAvaliacao` int(11) NOT NULL,
  `codAluno` int(11) NOT NULL,
  `nota` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `codDisciplina` int(11) NOT NULL,
  `curso` varchar(100) NOT NULL,
  `ementa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `codFuncionario` int(11) NOT NULL,
  `log_func` varchar(255) NOT NULL,
  `senha` varchar(25) DEFAULT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`codFuncionario`, `log_func`, `senha`, `nome`) VALUES
(1, 'Funcionario', '123', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE `matricula` (
  `codAluno` int(11) NOT NULL,
  `codTurma` int(11) NOT NULL,
  `media` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `codProfessor` int(11) NOT NULL,
  `log_professor` varchar(255) NOT NULL,
  `senha` varchar(25) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `formacao` varchar(100) NOT NULL,
  `salario` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`codProfessor`, `log_professor`, `senha`, `nome`, `endereco`, `formacao`, `salario`) VALUES
(1, 'Professor', '', '123', '', '', 0),
(2, 'Teste', '123', 'Teste', 'Rua', 'teste', 1200);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prova`
--

CREATE TABLE `prova` (
  `codAvaliacao` int(11) NOT NULL,
  `codQuestao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao`
--

CREATE TABLE `questao` (
  `codQuestao` int(11) NOT NULL,
  `enunciado` varchar(255) NOT NULL,
  `respCerta` varchar(100) NOT NULL,
  `resp2` varchar(100) NOT NULL,
  `resp3` varchar(100) NOT NULL,
  `resp4` varchar(100) NOT NULL,
  `codDisciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `codTurma` int(11) NOT NULL,
  `sala` varchar(50) NOT NULL,
  `horario` varchar(50) NOT NULL,
  `codProfessor` int(11) NOT NULL,
  `codDisciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`codAluno`);

--
-- Indexes for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`codAvaliacao`),
  ADD KEY `fk_avaliacao_turma` (`codTurma`);

--
-- Indexes for table `avaliacao_aluno`
--
ALTER TABLE `avaliacao_aluno`
  ADD PRIMARY KEY (`codAvaliacao`,`codAluno`),
  ADD KEY `fk_aluno_avaliacao` (`codAluno`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`codDisciplina`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`codFuncionario`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`codAluno`,`codTurma`),
  ADD KEY `fk_matricula_turma` (`codTurma`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`codProfessor`);

--
-- Indexes for table `prova`
--
ALTER TABLE `prova`
  ADD PRIMARY KEY (`codAvaliacao`,`codQuestao`),
  ADD KEY `fk_prova_questao` (`codQuestao`);

--
-- Indexes for table `questao`
--
ALTER TABLE `questao`
  ADD PRIMARY KEY (`codQuestao`),
  ADD KEY `fk_questao_disciplina` (`codDisciplina`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`codTurma`),
  ADD KEY `fk_turma_professor` (`codProfessor`),
  ADD KEY `fk_turma_disciplina` (`codDisciplina`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `codAluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `codAvaliacao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `codDisciplina` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `codFuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `codProfessor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `questao`
--
ALTER TABLE `questao`
  MODIFY `codQuestao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `codTurma` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `fk_avaliacao_turma` FOREIGN KEY (`codTurma`) REFERENCES `turma` (`codTurma`);

--
-- Limitadores para a tabela `avaliacao_aluno`
--
ALTER TABLE `avaliacao_aluno`
  ADD CONSTRAINT `fk_aluno_avaliacao` FOREIGN KEY (`codAluno`) REFERENCES `aluno` (`codAluno`),
  ADD CONSTRAINT `fk_avaliacao_aluno` FOREIGN KEY (`codAvaliacao`) REFERENCES `avaliacao` (`codAvaliacao`);

--
-- Limitadores para a tabela `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `fk_matricula_aluno` FOREIGN KEY (`codAluno`) REFERENCES `aluno` (`codAluno`),
  ADD CONSTRAINT `fk_matricula_turma` FOREIGN KEY (`codTurma`) REFERENCES `turma` (`codTurma`);

--
-- Limitadores para a tabela `prova`
--
ALTER TABLE `prova`
  ADD CONSTRAINT `fk_prova_avaliacao` FOREIGN KEY (`codAvaliacao`) REFERENCES `avaliacao` (`codAvaliacao`),
  ADD CONSTRAINT `fk_prova_questao` FOREIGN KEY (`codQuestao`) REFERENCES `questao` (`codQuestao`);

--
-- Limitadores para a tabela `questao`
--
ALTER TABLE `questao`
  ADD CONSTRAINT `fk_questao_disciplina` FOREIGN KEY (`codDisciplina`) REFERENCES `disciplina` (`codDisciplina`);

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_turma_disciplina` FOREIGN KEY (`codDisciplina`) REFERENCES `disciplina` (`codDisciplina`),
  ADD CONSTRAINT `fk_turma_professor` FOREIGN KEY (`codProfessor`) REFERENCES `professor` (`codProfessor`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
